@extends('pakka::admin.default')

@section('page-header')
	Menu <small>{{ trans('pakka::app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\MenuController@store'],
			'files' => true
		])
	!!}

		@include('pakka::admin.menu.form')

		<button type="submit" class="btn btn-primary">{{ trans('pakka::app.add_button') }}</button>
		
	{!! Form::close() !!}
	
@stop
