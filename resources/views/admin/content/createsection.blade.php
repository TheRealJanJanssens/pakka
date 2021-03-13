@extends('pakka::admin.default')

@section('page-header')
	{{ trans('pakka::app.section') }} <small>{{ trans('pakka::app.new') }}</small>
@stop

@section('content')
	{!! Form::open([
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\ContentController@storeSection'],
			'files' => true
		])
	!!}

		@include('pakka::admin.content.sectionform')
		
	{!! Form::close() !!}
	
@stop
