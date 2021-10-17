<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use ApTheRealJanJanssens\Pakka\Models\OrderDocument;
use Illuminate\Http\Request;
use PDF;
use TheRealJanJanssens\Pakka\Models\Invoice;
use TheRealJanJanssens\Pakka\Models\InvoiceDetail;
use TheRealJanJanssens\Pakka\Models\Order;
use TheRealJanJanssens\Pakka\Models\OrderDetail;
use TheRealJanJanssens\Pakka\Models\OrderShipment;
use TheRealJanJanssens\Pakka\Models\User;
use TheRealJanJanssens\Pakka\Models\UserDetail;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        constructGlobVars();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::getOrders();

        return view('pakka::admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::getOrder($id);

        return view('pakka::admin.orders.detail', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function editDetails($id)
    {
        $order = Order::getOrder($id);

        return view('pakka::admin.orders.form_details', compact('order'));
    }

    public function updateDetails(Request $request, $id)
    {
        $array = $request->all();
        $orderDetails = OrderDetail::findOrFail($id);
        $userId = $orderDetails->user_id;

        if ($array['status'] == 1) {
            //USER
            $user = User::findOrFail($userId);
            $this->validate($request, User::rules(true, $userId));
            $user->update($request->all());

            //USER DETAILS
            $userDetails = UserDetail::where('user_id', '=', $userId)->firstOrFail();
            $request->request->add(['user_id' => $userId]);
            $this->validate($request, UserDetail::rules(true, $userId));
            $userDetails->update($request->all());

            //INVOICE DETAILS
            $documents = OrderDocument::where('order_id', $orderDetails->order_id)->get()->toArray();
            if (! empty($documents)) {
                foreach ($documents as $document) {
                    if (! empty($array['company_name'])) {
                        $name = $array['company_name'];
                    } else {
                        $name = $array['firstname'].' '.$array['lastname'];
                    }

                    InvoiceDetail::where('invoice_id', $document['document_id'])->update([
                        'client_name' => $name,
                        'client_address' => $array['address'],
                        'client_city' => $array['city'],
                        'client_zip' => $array['zip'],
                        'client_country' => $array['country'],
                        'client_vat' => $array['vat'],
                        'client_email' => $array['email'],
                        'client_phone' => $array['phone'],
                    ]);
                }
            }
        }

        $orderDetails->update($array);

        return redirect()->route(config('pakka.prefix.admin'). '.orders.show', $orderDetails->order_id)->withSuccess(trans('pakka::app.success_update'));
    }

    public function editShipment($id)
    {
        $order = Order::getOrder($id);

        return view('pakka::admin.orders.form_shipment', compact('order'));
    }

    public function updateShipment(Request $request, $id)
    {
        $array = $request->all();
        $item = OrderShipment::findOrFail($id);
        $item->update($array);

        if ($array['status'] == 1) {
            Order::resendShippingMail($item->order_id);
        }

        return redirect()->route(config('pakka.prefix.admin'). '.orders.show', $item->order_id)->withSuccess(trans('pakka::app.success_update'));
    }

    public function viewPackslip($id)
    {
        $order = Order::getOrder($id);
        $order = Invoice::calculateInvoice($order, true);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('documents.packslip', ['order' => $order])->setPaper('a4', 'portrait');
        $filename = $order['name'].'_'.trans('pakka::app.packslip');

        return $pdf->stream($filename . '.pdf');
    }

    public function downloadPackslip($id)
    {
        $order = Order::getOrder($id);
        $order = Invoice::calculateInvoice($order, true);

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('documents.packslip', ['order' => $order])->setPaper('a4', 'portrait');
        $filename = $order['name'].'_'.trans('pakka::app.packslip');

        return $pdf->download($filename . '.pdf');
    }

    public function resendOC($id)
    {
        //Order Confirmation
        Order::resendConfirmationMail($id);

        return back()->withSuccess(trans('pakka::app.succes_send_oc'));
    }

    public function resendSC($id)
    {
        //shipping confirmation
        Order::resendShippingMail($id);

        return back()->withSuccess(trans('pakka::app.succes_send_sc'));
    }

    public function retour($id)
    {
        //retour
        Order::cancel($id, 3);

        return back()->withSuccess(trans('pakka::app.status_retour'));
    }

    public function cancel($id)
    {
        //cancel
        Order::cancel($id);

        return back()->withSuccess(trans('pakka::app.status_cancel'));
    }
}
