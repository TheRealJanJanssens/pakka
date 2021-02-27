@extends('pakka::admin.default')

@section('page-header')
	Input <small>{{ trans('pakka::app.edit') }}</small>
@stop

@section('content')

	{!! Form::model($input, [
			'action' => ['InputController@update', $input['id']], 
			'method' => 'put',
			'files' => true
		])
	!!}

		@include('pakka::admin.inputs.form')
		
	{!! Form::close() !!}
	
@stop
