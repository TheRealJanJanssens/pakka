@extends('pakka::admin.default')

@section('page-header')
	Menu <small>{{ trans('pakka::app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($menuItem, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\MenuItemController@update', $menuItem['id']],
			'method' => 'put',
			'files' => true
		])
	!!}

		@include('pakka::admin.menu_items.form')

	{!! Form::close() !!}

@stop
