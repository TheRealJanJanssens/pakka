<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use TheRealJanJanssens\Pakka\Models\Booking;
use TheRealJanJanssens\Pakka\Models\Service;

class BookingController extends Controller
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
        $services = Service::getServices();

        return view('pakka::admin.bookings.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pakka::admin.bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->validate($result, Service::rules());
        $inputs = Booking::convertDates($request->all());
        $bookings = Booking::create($inputs);

        //return redirect()->route(config('pakka.prefix.admin'). '.bookings.index')->withSuccess(trans('pakka::app.success_store'));
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
        $booking = Booking::getBooking($id);
        
        return view('pakka::admin.bookings.edit', compact('booking'));
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
        //$this->validate($request->all(), Booking::rules(true, $id));
        $booking = Booking::findOrFail($id);

        $inputs = Booking::convertDates($request->all());
        $booking->update($inputs);
      
        //return redirect()->route(config('pakka.prefix.admin'). '.bookings.index')->withSuccess(trans('pakka::app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Booking::destroy($id);
    }
    
    public function getJson()
    {
        $result = Booking::getBookings();
        return response()->json($result);
    }
}
