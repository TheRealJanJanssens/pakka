@extends('pakka::admin.default')

@section('page-header')
    @if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif
	 
	<small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')
	{!! Form::model($service, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\CartServiceController@update', $service['id']],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.cart_services.form')
		
	{!! Form::close() !!}
	
@stop
