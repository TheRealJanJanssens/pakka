@extends('pakka::admin.default')

@section('page-header')
	@if(Session::has('module_name'))
		{{ Session::get('module_name')}}
	@endif 
	
	<small>{{ trans('pakka::app.input_manage') }}</small>
@stop

@section('content')

	<div class="mB-20">
        <a href="{{ route(config('pakka.prefix.admin'). '.items.createinput', Session::get('module_id')) }}" class="btn btn-info">
            Input {{ trans('pakka::app.add_button') }}
        </a>
    </div>


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table class="table table-bordered table-sort" cellspacing="0" width="100%"> <!-- table-striped  id="dataTable"-->
            <thead>
                <tr>
                    <th>{{ trans('pakka::app.name') }}</th>
                    <th>{{ trans('pakka::app.type') }}</th>
                    <th>{{ trans('pakka::app.actions') }}</th>
                </tr>
            </thead>
            
            <tfoot>
                <tr>
                    <th>{{ trans('pakka::app.name') }}</th>
                    <th>{{ trans('pakka::app.type') }}</th>
                    <th>{{ trans('pakka::app.actions') }}</th>
                </tr>
            </tfoot>
            
            <tbody data-action="/admin/items/sort/inputs">
                @foreach ($inputs as $input)
                    <tr class="item" data-id="{{ $input['id'] }}" data-position="">
                        <td>
	                        <i class="handle ti-line-double"></i>
	                        <a href="{{ route(config('pakka.prefix.admin'). '.items.editinput', [
	                        	'moduleId' => Session::get('module_id') , 
		                    	'id' => $input['id']
			                ]) }}">{{ $input['label'] }}</a>
					    </td>
                        <td>{{ $input['type'] }}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(config('pakka.prefix.admin'). '.items.editinput', [
			                        	'moduleId' => Session::get('module_id') , 
				                    	'id' => $input['id']
					                ]) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(config('pakka.prefix.admin'). '.items.destroyinput', $input['input_id']), 
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
            </tbody>
        
        </table>
    </div>
	
@stop
