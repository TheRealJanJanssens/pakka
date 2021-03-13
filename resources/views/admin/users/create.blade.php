@extends('pakka::admin.default')

@section('page-header')
	User <small>{{ trans('pakka::app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\UserController@store'],
			'files' => true
		])
	!!}

		@include('pakka::admin.users.form')
		
	{!! Form::close() !!}
	
@stop
