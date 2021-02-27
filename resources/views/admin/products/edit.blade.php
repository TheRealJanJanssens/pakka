@extends('pakka::admin.default')

@section('page-header')
	@if(Session::has('module_name'))
		{{ Session::get('module_name')}}
	@endif <small>{{ trans('pakka::app.new') }}</small>
@stop

@section('content')

	{!! Form::model($product, [
			'action' => ['ProductController@update', $product['id']],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.products.form')
		
	{!! Form::close() !!}
	
@stop
