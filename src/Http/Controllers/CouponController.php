<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

//use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TheRealJanJanssens\Pakka\Models\Coupon;

class CouponController extends Controller
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
        $coupons = Coupon::getCoupons();

        return view('pakka::admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pakka::admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Coupon::rules());
        $inputs = Coupon::convertDates($request->all());
        $coupon = Coupon::create($inputs);

        return redirect()->route(config('pakka.prefix.admin'). '.coupons.index')->withSuccess(trans('pakka::app.success_store'));
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
        $coupon = Coupon::getCoupon($id);

        return view('pakka::admin.coupons.edit', compact('coupon'));
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
        $this->validate($request, Coupon::rules(true, $id));

        $inputs = Coupon::convertDates($request->all());
        $coupon = Coupon::findOrFail($id);
        $coupon->update($inputs);

        return redirect()->route(config('pakka.prefix.admin'). '.coupons.index')->withSuccess(trans('pakka::app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::where('id', $id)->get()->toArray();

        Coupon::destroy($id);
        //couponschedule::where('Service_id',$id)->delete();

        return back()->withSuccess(trans('pakka::app.success_destroy'));
    }
}
