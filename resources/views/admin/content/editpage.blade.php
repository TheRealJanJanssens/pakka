@extends('pakka::admin.default')

@section('page-header')
	{{ trans('pakka::app.page') }} <small>{{ trans('pakka::app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($page, [
			'action' => ['ContentController@updatePage', $page['id']],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.content.pageform')
		
	{!! Form::close() !!}
	
@stop
