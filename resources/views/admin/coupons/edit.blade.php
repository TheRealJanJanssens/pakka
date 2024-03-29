@extends('pakka::admin.default')

@section('page-header')
    @if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif
	 
	<small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')
	{!! Form::model($coupon, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\CouponController@update', $coupon['id']],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.coupons.form')
		
	{!! Form::close() !!}
	
@stop
