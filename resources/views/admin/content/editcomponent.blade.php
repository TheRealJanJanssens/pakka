@extends('pakka::admin.default')

@section('page-header')
	{{ trans('pakka::app.component') }} <small>{{ trans('pakka::app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($component, [
			'action' => ['ContentController@updateComponent', $component->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.content.componentform')
		
	{!! Form::close() !!}
	
@stop
