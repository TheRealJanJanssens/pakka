@extends('pakka::admin.default')

@section('page-header')
	Section <small>{{ trans('pakka::app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\sectionmanagerController@store'],
			'files' => true
		])
	!!}

		@include('pakka::admin.sectionmanager.form')
		
	{!! Form::close() !!}
	
@stop
