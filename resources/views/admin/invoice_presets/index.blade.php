@extends('pakka::admin.default')

@section('page-header')
    @if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif
	 
	<small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')

    <div class="mB-30">
        <a href="{{ route(config('pakka.prefix.admin'). '.invoice_presets.create') }}" class="btn btn-primary-gradient">
	        <i class="ti-plus mR-10"></i>
            {{ trans('pakka::app.add_button') }}
        </a>
    </div>



    <div class="table-container bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-list table-striped" cellspacing="0" width="100%"> <!-- table-bordered -->
            <thead>
                <tr>
                    <th>{{ trans('pakka::app.name') }}</th>
                    <th>{{ trans('pakka::app.price') }}</th>
                    <th>{{ trans('pakka::app.quantity') }}</th>
                    <th>{{ trans('pakka::app.vatper') }}</th>
                    <th></th>
                </tr>
            </thead>
            
<!--
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
-->
            
            <tbody>
                @foreach ($items as $item)
                	<tr>
                        <td>
	                        <a href="{{ route(config('pakka.prefix.admin'). '.invoice_presets.edit', $item['id']) }}">			                        
		                        {{ $item['name'] }}
		                    </a>
		                </td>
                        <td>{{ $settings['invoice_valuta'] }}{{ str_replace('.', ',', $item['price']) }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['vat'] }}%</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(config('pakka.prefix.admin'). '.invoice_presets.edit', $item['id']) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary-gradient btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(config('pakka.prefix.admin'). '.invoice_presets.destroy', $item['id']), 
                                        'method' => 'DELETE',
                                        ]) 
                                    !!}

                                    <button class="btn btn-danger btn-sm" title="{{ trans('pakka::app.delete_title') }}"><i class="ti-trash"></i></button>
                                        
                                    {!! Form::close() !!}
                                </li>
                                
<!--
                                <li class="list-inline-item">
                                	<span>
                                		<i class="ti-more-alt" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;"><a class="dropdown-item" href="#">Action</a> <a class="dropdown-item" href="#">Another action</a> <a class="dropdown-item" href="#">Something else here</a></div>
                                	</span>
                                </li>
-->
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        
        </table>
    </div>

@endsection