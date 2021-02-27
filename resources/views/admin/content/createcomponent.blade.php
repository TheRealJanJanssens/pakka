@extends('pakka::admin.default')

@section('page-header')
	{{ trans('pakka::app.component') }} <small>{{ trans('pakka::app.new') }}</small>
@stop

@section('content')
	{!! Form::open([
			'action' => ['ContentController@storeComponent'],
			'files' => true
		])
	!!}

		@include('pakka::admin.content.componentform')
		
	{!! Form::close() !!}
	
@stop
