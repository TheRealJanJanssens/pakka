@extends('pakka::admin.default')

@section('page-header')
    @if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif
	 
	<small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')
	{!! Form::model($template, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\TemplateController@update', $template['id']],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.templates.form')
		
	{!! Form::close() !!}
	
@stop
