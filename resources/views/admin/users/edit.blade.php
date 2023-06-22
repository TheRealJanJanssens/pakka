@extends('pakka::admin.default')

@section('page-header')
	User <small>{{ trans('pakka::app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($user, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\UserController@update', $user->id],
			'method' => 'put',
			'files' => true
		])
	!!}

		@include('pakka::admin.users.form')

	{!! Form::close() !!}

@stop
