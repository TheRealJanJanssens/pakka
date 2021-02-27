@extends('pakka::admin.default')

@section('page-header')
	Menu <small>{{ trans('pakka::app.update_item') }}</small>
@stop

@section('content')
	
	{{ $item->name }}
	
@stop
