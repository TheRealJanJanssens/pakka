@extends('pakka::admin.default')

@section('page-header')
	Section <small>{{ trans('pakka::app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($item, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\sectionmanagerController@update', $item->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.sectionmanager.form')
		
	{!! Form::close() !!}
	
@stop
