<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

use Session;
use TheRealJanJanssens\Pakka\Models\Invoice;

use TheRealJanJanssens\Pakka\Models\InvoiceDetail;
use TheRealJanJanssens\Pakka\Models\InvoiceItem;
use TheRealJanJanssens\Pakka\Models\OrderDocument;
use TheRealJanJanssens\Pakka\Models\User;

use TheRealJanJanssens\Pakka\Models\UserDetail;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['viewInvoice','downloadInvoice']);
        constructGlobVars();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Invoice::getInvoices();

        return view('pakka::admin.invoices.index', compact('items'));
    }
    
    public function saveInvoice($request, $id = null)
    {
        $inputs = $request->all();
        
        if (! isset($id)) {
            $id = generateString(8);
            $task = "add";
        } else {
            $task = "update";
        }
        
        //Quick checkup if the necessary inputs are there
        if (! empty($inputs['client_email']) && ! empty($inputs['price'][0])) {
            
            //NEW CLIENT
            //if client id is empty make new client account
            if (empty($inputs['client_id']) && ! empty($inputs['client_email'])) {
                //create user
                $userData = $request;
                $userData->request->add([
                    'name' => $inputs['client_name'],
                    'company_name' => $inputs['client_name'],
                    'email' => $inputs['client_email'],
                    'role' => 1,'address' => $inputs['client_address'],
                    'zip' => $inputs['client_zip'],
                    'city' => $inputs['client_city'],
                    'country' => $inputs['client_country'],
                    'vat' => $inputs['client_vat'],
                ]);

                $this->validate($userData, User::rules());
                $user = User::create($userData->all());
                
                $request->request->add(['client_id' => $user->id]);
                $userData['user_id'] = $user->id;
                $this->validate($userData, UserDetail::rules());
                //creating user details
                UserDetail::create($userData->all());
            }
            
            $request->request->add(['id' => $id]);
            $request->request->add(['invoice_id' => $id]);
            
            switch ($task) {
                case "add":
                    //INVOICE
                    $this->validate($request, Invoice::rules());
                    $invoice = Invoice::create($request->all());
                    
                    //INVOICE DETAILS
                    $this->validate($request, InvoiceDetail::rules());
                    $invoice = InvoiceDetail::create($request->all());
                    
                    break;
                case "update":
                    //INVOICE
                    //$this->validate($request, Invoice::rules());
                    $invoiceUpdate = Invoice::findOrFail($id);
                    $invoiceUpdate->update($request->all());
                    
                    //INVOICE DETAILS
                    //$this->validate($request, InvoiceDetail::rules());
                    $invoiceDetailUpdate = InvoiceDetail::where('invoice_id', $id)->firstOrFail();
                    $invoiceDetailUpdate->update($request->all());
                    
                    //REMOVE INVOICE ITEMS TO INSERT NEW
                    InvoiceItem::where('invoice_id', $id)->delete();

                    break;
            }
            
            //INVOICE ITEMS
            $i = 0;
            foreach ($inputs['name'] as $name) {
                
                //if nothing is entered just return a space
                if (empty($name)) {
                    $name = " ";
                }
                
                $invoiceItem = [];
                $invoiceItem['invoice_id'] = $id;
                $invoiceItem['name'] = $name;
                $invoiceItem['position'] = $inputs['position'][$i];
                $invoiceItem['quantity'] = $inputs['quantity'][$i];
                $invoiceItem['price'] = str_replace(',', '.', $inputs['price'][$i]);
                $invoiceItem['vat'] = $inputs['vat'][$i];
                
                InvoiceItem::create($invoiceItem);
                $i++;
            }
            
            if (! empty($inputs['order_id'])) {
                $insert = ['order_id' => $inputs['order_id'], 'document_id' => $id];
                $document = OrderDocument::updateOrCreate($insert);
            }
        } else {
            return redirect()->back()->withInput()->withErrors(trans('pakka::app.error_fill_all'));
        }
        
        return redirect('/admin/invoices')->withSuccess(trans('pakka::app.success_store'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $document = Invoice::getNewInvoiceDetails();

        return view('pakka::admin.invoices.create', compact('document'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->saveInvoice($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $settings = Session::get('settings');
        $document = Invoice::getInvoice($id);
        $document['date'] = formatDate($document['date'], "Y-m-d");
        $document['due_date'] = formatDate($document['due_date'], "Y-m-d");
        $newInvoiceDetails = Invoice::getNewInvoiceDetails();

        //also replace creditnota id if it uses same numbering as invoice
        switch ($document['type']) {
            case 1:
                $newInvoiceDetails['document_numbers']['1'] = $document['invoice_no'];
                
                if ($settings['invoice_multiple_numbers'] !== "1") {
                    $newInvoiceDetails['document_numbers']['2'] = $document['invoice_no'];
                }

                break;
            case 2:
                // ensures to get replace the new creditnote number to the one which was set on creation
                $newInvoiceDetails['document_numbers']['2'] = $document['invoice_no'];

                break;
        }
        
        $document['document_numbers'] = $newInvoiceDetails['document_numbers'];
        
        if ($document['ship_address']) {
            $document['other_shipping_info'] = 1;
        }
        
        return view('pakka::admin.invoices.edit', compact('document'));
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
        return $this->saveInvoice($request, $id);
    }
    
    public function copy($id, $order = null, $credit = null)
    {
        $document = Invoice::getInvoice($id);
        
        if ($order) {
            $document['order_id'] = $order;
        }
        
        if ($credit) {
            $i = 0;
            foreach ($document['items'] as $item) {
                $document['items'][$i]['price'] = -1 * abs($item['price']);
                $i++;
            }
        }
        
        unset($document['date']);
        unset($document['due_date']);
        $document = array_merge($document, Invoice::getNewInvoiceDetails());
        
        if ($document['ship_address']) {
            $document['other_shipping_info'] = 1;
        }

        return view('pakka::admin.invoices.copy', compact('document'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Invoice::destroy($id);
        InvoiceDetail::where('invoice_id', $id)->delete();
        InvoiceItem::where('invoice_id', $id)->delete();
        OrderDocument::where('document_id', $id)->delete();
        
        return back()->withSuccess(trans('pakka::app.success_destroy'));
    }
    
    public function viewInvoice($id)
    {
        $invoice = Invoice::getInvoice($id);
        $invoice['date'] = formatDate($invoice['date'], "d-m-Y");
        $invoice['due_date'] = formatDate($invoice['due_date'], "d-m-Y");
        
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pakka::documents.invoice', ['invoice' => $invoice])->setPaper('a4', 'portrait');
        $filename = $invoice['invoice_no'];
        
        return $pdf->stream($filename . '.pdf');

        //return view('documents.invoice');
    }
    
    public function downloadInvoice($id)
    {
        $invoice = Invoice::getInvoice($id);
        $invoice['date'] = formatDate($invoice['date'], "d-m-Y");
        $invoice['due_date'] = formatDate($invoice['due_date'], "d-m-Y");
        
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('pakka::documents.invoice', ['invoice' => $invoice])->setPaper('a4', 'portrait');
        $filename = $invoice['invoice_no'];
        
        return $pdf->download($filename . '.pdf');

        //return view('documents.invoice');
    }
}
