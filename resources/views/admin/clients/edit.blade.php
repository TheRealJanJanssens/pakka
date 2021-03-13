@extends('pakka::admin.default')

@section('page-header')
	{{ trans("pakka::app.client") }} <small>{{ trans('pakka::app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($item, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\ClientController@update', $item->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.clients.form')
		
	{!! Form::close() !!}
	
@stop
