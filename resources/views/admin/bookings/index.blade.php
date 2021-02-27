@extends('pakka::admin.default')

@section('page-header')
    @if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif
	 
	<small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')

<div class="row">
   <div class="col-md-4 mB-40">
      <div id="calendar-widget" class="ov-h bgc-white bd">

	      <?php
		      $upcomingBookings = \App\Booking::getUpcomingBookings();
		      
		      if(!empty($upcomingBookings) && isset($upcomingBookings[0])){
			      $closestBooking = $upcomingBookings[0];
		      }
	      ?>
	      
         <div class="bg-primary-gradient ta-c p-30">
	        @if(isset($closestBooking))
				 <h6 class="fw-300 c-white">{{ trans('pakka::app.booking_assets.'.$settings['booking_type'].'.first_booking') }}</h6>
				 <h1 class="fw-300 mB-5 lh-1 c-white">{{ Carbon\Carbon::parse($closestBooking['start_at'])->translatedFormat('d M') }}</h1>
				 <h3 class="c-white">{{ Carbon\Carbon::parse($closestBooking['start_at'])->translatedFormat('l') }}</h3>
			@else
				<h3 class="c-white">{{ trans('pakka::app.booking_assets.'.$settings['booking_type'].'.no_bookings') }}</h3>
			@endif
         </div>
         
         <div class="pos-r">
            <button type="button" class="event-add mT-nv-50 pos-a r-10 t-2 btn cur-p bdrs-50p p-0 w-3r h-3r btn-success">
            	<i class="fa fa-plus"></i>
            </button>
            
            <ul class="m-0 p-0 mT-20">
	            
	            @if(isset($closestBooking))
		            @php($i = 0)
		            @php($len = count($upcomingBookings))
		            
		            @foreach($upcomingBookings as $booking)
		            	
						<li class="@if($i !== $len - 1) bdB @endif peers ai-c jc-sb fxw-nw">
		                  <a class="event-edit td-n p-20 peers fxw-nw mR-20 peer-greed c-grey-900" href="javascript:void(0)" data-id="{{ $booking['id'] }}" data-toggle="modal" data-target="#calendar-edit">
		                     <div class="peer mR-15"><i class="fa fa-fw fa-clock-o c-red-500"></i></div>
		                     <div class="peer">
		                        <span class="fw-600">{{ $booking['title'] }}</span>
		                        <div class="c-grey-600"><span class="c-grey-700"> {{ Carbon\Carbon::parse($booking['start_at'])->translatedFormat('l d M - H:i') }} </span><i></i></div>
		                     </div>
		                  </a>
		                  
		                  <div class="peers mR-15">
		                     <div class="peer">
			                     <a href="javascript:void(0)" data-id="{{ $booking['id'] }}" class="event-edit btn btn-sm btn-primary">
				                     <i class="ti-pencil"></i>
				                </a>
				            </div>
				            
		                    <div class="peer">
			                    <a href="javascript:void(0)" data-id="{{ $booking['id'] }}" class="event-delete-alert btn btn-sm btn-danger mL-5">
				                    <i class="ti-trash"></i>
				                </a>
				            </div>
		                  </div>
		               </li>
		               
					   @php($i++)
		            @endforeach
	            @else
		            <div class="text-center p-20">
						<a href="javascript:void(0)" class="event-add btn btn-success">
							<i class="ti-plus mR-10"></i>Voeg toe
						</a>
		            </div>
				@endif
            </ul>
         </div>
      </div>
   </div>
   
   <div class="col-md-8">
      <div id="full-calendar" class="bd p-10">
      </div>
   </div>
   
</div>

@endsection