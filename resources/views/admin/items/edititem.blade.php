@extends('pakka::admin.default')

@section('page-header')
	@if(Session::has('module_name'))
		{{ Session::get('module_name')}}
	@endif <small>{{ trans('pakka::app.new') }}</small>
@stop

@section('content')

	{!! Form::model($item, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\ItemController@updateItem', $item['id']],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.items.itemsform')
		
	{!! Form::close() !!}
	
@stop
