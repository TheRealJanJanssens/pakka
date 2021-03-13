@extends('pakka::admin.default')

@section('page-header')
	{{ trans('pakka::app.page') }} <small>{{ trans('pakka::app.new') }}</small>
@stop

@section('content')
	{!! Form::open([
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\ContentController@storePage'],
			'files' => true
		])
	!!}

		@include('pakka::admin.content.pageform')
		
	{!! Form::close() !!}
	
@stop
