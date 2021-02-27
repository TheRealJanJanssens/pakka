@extends('pakka::admin.default')

@section('page-header')
    @if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif
	 
	<small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')
	{!! Form::open([
			'action' => ['ShipmentController@store'],
			'files' => true
		])
	!!}

		@include('pakka::admin.shipments.form')
		
	{!! Form::close() !!}
	
@stop
