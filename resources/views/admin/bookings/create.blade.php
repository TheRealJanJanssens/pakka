{!! Form::open([
		'action' => ['BookingController@store'],
		'method' => 'post',
		'class' => 'booking-form', 
		'files' => true
	])
!!}

	@include('pakka::admin.bookings.form')
	
{!! Form::close() !!}
