@extends('pakka::admin.default')

@section('page-header')
	@if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif
	 
	<small>{{ trans('pakka::app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\ProvidersController@store'],
			'files' => true
		])
	!!}

		@include('pakka::admin.providers.form')
		
	{!! Form::close() !!}
	
@stop
