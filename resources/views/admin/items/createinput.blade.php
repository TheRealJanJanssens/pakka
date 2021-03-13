@extends('pakka::admin.default')

@section('page-header')
	Input <small>{{ trans('pakka::app.new') }}</small>
@stop

@section('content')

	{!! Form::open([
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\ItemController@storeInput'], 
			'files' => true
		])
	!!}

		@include('pakka::admin.items.inputsform')
		
	{!! Form::close() !!}
	
@stop
