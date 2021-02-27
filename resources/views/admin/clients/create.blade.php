@extends('pakka::admin.default')

@section('page-header')
	{{ trans("pakka::app.client") }} <small>{{ trans('pakka::app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'action' => ['ClientController@store'],
			'files' => true
		])
	!!}

		@include('pakka::admin.clients.form')
		
	{!! Form::close() !!}
	
@stop
