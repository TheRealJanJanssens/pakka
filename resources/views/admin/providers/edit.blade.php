@extends('pakka::admin.default')

@section('page-header')
	User <small>{{ trans('pakka::app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($provider, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\ProvidersController@update', $provider['id']],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.providers.form')
		
	{!! Form::close() !!}
	
@stop
