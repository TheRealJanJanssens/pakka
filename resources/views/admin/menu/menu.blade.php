@extends('pakka::admin.default')

@section('page-header')
	Menu <small>{{ trans('pakka::app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'action' => ['MenuController@store'],
			'files' => true
		])
	!!}

		@include('pakka::admin.menu.form')
		
	{!! Form::close() !!}
	
@stop
