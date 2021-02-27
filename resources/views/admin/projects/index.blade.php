@extends('pakka::admin.default')

@section('page-header')
    {{ trans('pakka::app.projects') }}
	
	<small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')
	
	@if(isset($settings['item_layout']))
		@php($layout = intval($settings['item_layout']))
	@else
		@php($layout = 3)
		@php(Session::put('item_layout',$layout))
	@endif
	
    <div class="action-bar mB-20 row">
	    <div class="col-6">
	        <a href="#" class="btn btn-info">
	            {{ trans('pakka::app.add_button') }}
	        </a>
        </div>        
    </div>
	
	<div class="table-container bgc-white bd p-20 mB-20">
        <table class="table table-list table-striped" cellspacing="0" width="100%"> <!-- table-striped  id="dataTable"-->
            <thead>
                <tr>
                    <th>{{ trans('pakka::app.name') }}</th>
                    <th>{{ trans('pakka::app.status') }}</th>
                    <th></th>
                </tr>
            </thead>
            	@if (!empty($projects))
	            	@foreach ($projects as $project)
	                    <tr>
	                        <td>
		                        <a href="{{ route(ADMIN . '.projects.detail', ['id' => $project['id']]) }}" class="link">{{ $project['name'] }}</a>
		                    </td>
	                        <td>
		                        @if ($project['status'] == 1)
		                        	<div class="status-icon status-icon-green"></div>
		                        	{{ trans('pakka::app.online') }}
		                        @else
		                        	<div class="status-icon status-icon-red"></div>
		                        	{{ trans('pakka::app.offline') }}
		                        @endif
		                        
	                        </td>
	                        <td>
	                            <ul class="list-inline">
	                                <li class="list-inline-item">
	                                    <a href="#" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
	                                <li class="list-inline-item">
	                                    {!! Form::open([
	                                        'class'=>'delete',
	                                        'url'  => '#', 
	                                        'method' => 'DELETE',
	                                        ]) 
	                                    !!}
	
	                                        <button class="btn btn-danger btn-sm" title="{{ trans('pakka::app.delete_title') }}"><i class="ti-trash"></i></button>
	                                        
	                                    {!! Form::close() !!}
	                                </li>
	                            </ul>
	                        </td>
	                    </tr>
	                @endforeach
				@else
	            	<tr id="list-noresult"><td colspan="3">{{ trans('pakka::app.no_results') }}</td></tr>
				@endif
<!--
            <tfoot>
                <tr>
                    <th>{{ trans('pakka::app.name') }}</th>
                    <th>{{ trans('pakka::app.status') }}</th>
                    <th>{{ trans('pakka::app.actions') }}</th>
                </tr>
            </tfoot>
-->
            
            <tbody>
                
            </tbody>
        
        </table>
    </div>

@endsection