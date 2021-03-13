{!! Form::open([
		'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\BookingController@store'],
		'method' => 'post',
		'class' => 'booking-form', 
		'files' => true
	])
!!}

	@include('pakka::admin.bookings.form')
	
{!! Form::close() !!}
