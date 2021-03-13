@extends('pakka::admin.default')

@section('page-header')
	{{ trans("pakka::app.invoice") }} <small>{{ trans('pakka::app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::model($document, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\InvoiceController@store'],
			'files' => true
		])
	!!}

		@include('pakka::admin.invoices.form')
		
	{!! Form::close() !!}
	
@stop
