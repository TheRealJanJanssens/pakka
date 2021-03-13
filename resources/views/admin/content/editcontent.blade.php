@extends('pakka::admin.default')

@section('page-header')
	@if(Session::has('module_name'))
		{{ Session::get('module_name')}}
	@endif <small>{{ trans('pakka::app.new') }}</small>
@stop

@section('content')

	{!! Form::model($item, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\ContentController@updateContent', $item->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.content.contentform')
		
	{!! Form::close() !!}
	
@stop
