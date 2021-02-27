@extends('pakka::admin.default')

@section('page-header')
	@if(Session::has('module_name'))
		{{ Session::get('module_name')}}
	@endif <small>{{ trans('pakka::app.new') }}</small>
@stop

@section('content')

	{!! Form::open([
			'action' => ['ItemController@storeItem'], 
			'files' => true
		])
	!!}

		@include('pakka::admin.items.itemsform')
		
	{!! Form::close() !!}
	
@stop
