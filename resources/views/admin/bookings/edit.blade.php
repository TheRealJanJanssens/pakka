{!! Form::model($booking, [
		'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\BookingController@update', $booking->id],
		'method' => 'put',
		'class' => 'booking-form', 
		'files' => true
	])
!!}

	@include('pakka::admin.bookings.form')
	
{!! Form::close() !!}