@extends('pakka::admin.default')

@section('page-header')
	Menu <small>{{ trans('pakka::app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($menuItem, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\MenuController@updateMenuItem', $menuItem['id']],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.menu.menuitemform')
		
	{!! Form::close() !!}
	
@stop
