@extends('pakka::admin.default')

@section('page-header')
    @if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif
	 
	<small>{{ trans('pakka::app.update_item') }}</small>
@endsection

@section('content')
	{!! Form::model($item, [
			'action' => ['InvoicePresetController@update', $item['id']],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.invoice_presets.form')
		
	{!! Form::close() !!}
	
@stop
