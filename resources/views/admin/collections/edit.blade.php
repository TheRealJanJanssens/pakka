@extends('pakka::admin.default')

@section('page-header')
    @if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif
	 
	<small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')
	{!! Form::model($collection, [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\CollectionController@update', $collection['id']],
			'method' => 'put', 
			'files' => true
		])
	!!}

		@include('pakka::admin.collections.form')
		
	{!! Form::close() !!}
	
@stop
