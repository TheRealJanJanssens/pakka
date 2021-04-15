@extends('pakka::admin.default')

@section('page-header')
	Menu <small>{{ trans('pakka::app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\MenuController@storeMenu'],
			'files' => true
		])
	!!}

	@include('pakka::admin.menu.menuform')
		
	{!! Form::close() !!}
	
@stop
