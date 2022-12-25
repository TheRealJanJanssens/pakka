@extends('pakka::admin.default')

@section('page-header')
	Menu <small>{{ trans('pakka::app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\MenuItemController@store'],
			'files' => true
		])
	!!}

	@include('pakka::admin.menu_items.form')

	{!! Form::close() !!}

@stop
