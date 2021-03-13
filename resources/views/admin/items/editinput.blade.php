@extends('pakka::admin.default')

@section('page-header')
	Input <small>{{ trans('pakka::app.edit') }}</small>
@stop

@section('content')

	{!! Form::model($input, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\ItemController@updateInput', $input['id']], 
			'method' => 'put',
			'files' => true
		])
	!!}

		@include('pakka::admin.items.inputsform')
		
	{!! Form::close() !!}
	
@stop
