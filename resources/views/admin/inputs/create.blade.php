@extends('pakka::admin.default')

@section('page-header')
	Input <small>{{ trans('pakka::app.new') }}</small>
@stop

@section('content')

	{!! Form::open([
			'action' => ['InputController@store'], 
			'files' => true
		])
	!!}

		@include('pakka::admin.inputs.form')
		
	{!! Form::close() !!}
	
@stop
