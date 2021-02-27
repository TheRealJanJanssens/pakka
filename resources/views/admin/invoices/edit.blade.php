@extends('pakka::admin.default')

@section('page-header')
	{{ trans("pakka::app.invoice") }} <small>{{ trans('pakka::app.update_item') }}</small>
@stop

@section('content')
	{!! Form::model($document, [
			'action' => ['InvoiceController@update', $document['id']],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.invoices.form')
		
	{!! Form::close() !!}
	
@stop
