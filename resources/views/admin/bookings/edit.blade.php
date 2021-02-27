{!! Form::model($booking, [
		'action' => ['BookingController@update', $booking->id],
		'method' => 'put',
		'class' => 'booking-form', 
		'files' => true
	])
!!}

	@include('pakka::admin.bookings.form')
	
{!! Form::close() !!}