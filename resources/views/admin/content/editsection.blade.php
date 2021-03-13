@extends('pakka::admin.default')

@section('page-header')
	{{ trans('pakka::app.section') }} <small>{{ trans('pakka::app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($section, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\ContentController@updateSection', $section->id],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.content.sectionform')
		
	{!! Form::close() !!}
	
@stop
