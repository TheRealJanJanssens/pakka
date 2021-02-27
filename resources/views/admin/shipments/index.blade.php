@extends('pakka::admin.default')

@section('page-header')
    @if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif
	 
	<small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(ADMIN . '.shipments.create') }}" class="btn btn-info">
            {{ trans('pakka::app.add_button') }}
        </a>
    </div>


    <div class="table-container bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-list table-striped" cellspacing="0" width="100%"> <!-- table-bordered -->
            <thead>
                <tr>
                    <th>{{ trans('pakka::app.name') }}</th>
                    <th>{{ trans('pakka::app.price') }}</th>
                    <th>{{ trans('pakka::app.status') }}</th>
                    <th>{{ trans('pakka::app.region') }}</th>
                    <th></th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($shipments as $shipment)
                    <tr>
                        <td><a href="{{ route(ADMIN . '.shipments.edit', $shipment['id']) }}">{{ $shipment['name'] }}</a></td>
                        <td>
	                        <b>€{{ $shipment['price'] }}</b>
                        </td>
                        <td>
	                        @if ($shipment['status'] == 1)
	                        	<div class="status-icon status-icon-green"></div>
	                        	{{ trans('pakka::app.online') }}
	                        @else
	                        	<div class="status-icon status-icon-red"></div>
	                        	{{ trans('pakka::app.offline') }}
	                        @endif
	                        
                        </td>
                        <td>
	                        {{ $shipment['region'] }}
                        </td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.shipments.edit', $shipment['id']) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.shipments.destroy', $shipment['id']), 
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

@endsection