@extends('pakka::admin.default')

@section('page-header')
	{{ trans('pakka::app.page') }} <small>{{ trans('pakka::app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($page, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\ContentController@updatePage', $page['id']],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.content.pageform')
		
	{!! Form::close() !!}
	
@stop
