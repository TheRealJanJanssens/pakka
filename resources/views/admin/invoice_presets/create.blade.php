@extends('pakka::admin.default')

@section('page-header')
    @if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif
	 
	<small>{{ trans('pakka::app.add_new_item') }}</small>
@endsection

@section('content')
	{!! Form::open([
			'action' => ['InvoicePresetController@store'],
			'files' => true
		])
	!!}

		@include('pakka::admin.invoice_presets.form')
		
	{!! Form::close() !!}
	
@stop
