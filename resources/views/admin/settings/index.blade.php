@extends('pakka::admin.default')

@section('page-header')
	{{ trans('pakka::app.settings') }} <!-- <small>{{ trans('pakka::app.new') }}</small> -->
@stop

@section('content')

	{!! Form::model($values, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\SettingController@updateSettings'],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.settings.settingsform')
		
	{!! Form::close() !!}
	
@stop
