@extends('pakka::admin.default')

@section('page-header')
	Menu <small>{{ trans('pakka::app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($item, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\MenuController@update', $item->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.menu.form')

		<button type="submit" class="btn btn-primary">{{ trans('pakka::app.edit_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
