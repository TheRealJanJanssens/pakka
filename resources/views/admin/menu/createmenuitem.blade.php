@extends('pakka::admin.default')

@section('page-header')
	Menu <small>{{ trans('pakka::app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			//'route' => [config('pakka.prefix.admin').'.menu.storemenuitem'],
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\MenuController@storeMenuItem'],
			'files' => true
		])
	!!}

	@include('pakka::admin.menu.menuitemform')
		
	{!! Form::close() !!}
	
@stop
