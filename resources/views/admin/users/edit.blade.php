@extends('pakka::admin.default')

@section('page-header')
	User <small>{{ trans('pakka::app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($item, [
			'action' => ['UserController@update', $item->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.users.form')
		
	{!! Form::close() !!}
	
@stop
