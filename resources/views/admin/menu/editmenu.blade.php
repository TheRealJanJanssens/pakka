@extends('pakka::admin.default')

@section('page-header')
	Menu <small>{{ trans('pakka::app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($item, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\MenuController@updateMenu', $item->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

	@include('pakka::admin.menu.menuform')
		
	{!! Form::close() !!}
	
@stop
