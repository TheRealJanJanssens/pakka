@extends('pakka::admin.default')

@section('page-header')
    @if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif 
	
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
	        <a href="{{ route(config('pakka.prefix.admin'). '.products.create') }}" class="btn btn-info">
	            {{ trans('pakka::app.add_button') }}
	        </a>

	        @if(checkAcces("permission_input_edit"))
		        <a href="{{ route(config('pakka.prefix.admin'). '.inputs.index', Session::get('set_id')) }}" class="btn btn-info">
		            Inputs {{ trans('pakka::app.admin') }}
		        </a>
	        @endif
        </div>
        
        <div class="col-6">
	        <div class="button-group">
		        <a href="{{ route(config('pakka.prefix.admin'). '.products.layoutswitch', 1) }}" class="button-group-item @if($layout == 1) {{'active'}} @endif"><i class="ti-view-list-alt"></i></a>
		        <a href="{{ route(config('pakka.prefix.admin'). '.products.layoutswitch', 3) }}" class="button-group-item  @if($layout == 3) {{'active'}} @endif"><i class="ti-view-grid"></i></a>
	        </div>
        </div>
        
    </div>
	
	@switch($layout)
	    @case(1)
	        <div class="table-container bgc-white bd p-20 mB-20">
		        <table class="table table-list table-striped" cellspacing="0" width="100%"> <!-- table-striped  id="dataTable"-->
		            <thead>
		                <tr>
		                    <th>{{ trans('pakka::app.name') }}</th>
		                    <th>{{ trans('pakka::app.status') }}</th>
		                    <th></th>
		                </tr>
		            </thead>
		            	@if (!empty($products))
			            	@foreach ($products as $product)
			                    <tr>
			                        <td>
				                        @if ($product['images'] !== null)
				                        	<div class="table-image"><img src="{{ imgUrl($product['id'] ,$product['images'][0], 100) }}"></div>
				                        @endif
			
				                        <a href="{{ route(config('pakka.prefix.admin'). '.products.edit', $product['id']) }}" class="link">{{ htmlspecialchars_decode($product['name']) }}</a>
				                    </td>
			                        <td>
				                        @if ($product['status'] == 1)
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
			                                    <a href="{{ route(config('pakka.prefix.admin'). '.products.edit', $product['id']) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
			                                <li class="list-inline-item">
			                                    {!! Form::open([
			                                        'class'=>'delete',
			                                        'url'  => route(config('pakka.prefix.admin'). '.products.destroy', $product['id']), 
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
	        @break
	    @case(2)
	        <div class="table-container bgc-white bd p-20 mB-20">
		        <table id="dataTable" class="table table-list table-striped" cellspacing="0" width="100%"> <!-- table-striped  id="dataTable"-->
		            <thead>
		                <tr>
		                    <th>{{ trans('pakka::app.name') }}</th>
		                    <th>{{ trans('pakka::app.status') }}</th>
		                    <th></th>
		                </tr>
		            </thead>
		            	@if (!empty($products))
			            	@foreach ($products as $product)
			                    <tr>
			                        <td>
				                        @if ($product['images'] !== null)
				                        	<div class="table-image"><img src="{{ imgUrl($product['id'] ,$product['images'][0], 100) }}"></div>
				                        @endif
			
				                        <a href="{{ route(config('pakka.prefix.admin'). '.products.edit', $product['id']) }}" class="link">{{ htmlspecialchars_decode($product['name']) }}</a>
				                    </td>
			                        <td>
				                        @if ($product['status'] == 1)
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
			                                    <a href="{{ route(config('pakka.prefix.admin'). '.products.edit', $product['id']) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
			                                <li class="list-inline-item">
			                                    {!! Form::open([
			                                        'class'=>'delete',
			                                        'url'  => route(config('pakka.prefix.admin'). '.products.destroy', $product['id']), 
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
	        @break
	    @case(3)
	        <div class="bgc-white bd p-20 mB-20">
				<div class="item-list row">
					@if (!empty($products))
						@foreach ($products as $product)
			                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
				                <div class="item">
					                <div class="item-inner">
						                <div class="item-image">
							                @if ($product['images'] !== null)
					                        	<img src="{{ imgUrl($product['id'] ,$product['images'][0], 300) }}">
					                        @else
					                        	<span class="ti-image"></span>
					                        @endif
							                <div class="item-status">
								                @if ($product['status'] == 1)
						                        	<div class="status-icon status-icon-green"></div>
						                        	{{ trans('pakka::app.online') }}
						                        @else
						                        	<div class="status-icon status-icon-red"></div>
						                        	{{ trans('pakka::app.offline') }}
						                        @endif
						                	</div>
						                </div>
						                
						                <div class="item-text">
							                <p>{{ htmlspecialchars_decode($product['name']) }}</p>
						                </div>
						                
						                <div class="item-actions">
							                <a href="{{ route(config('pakka.prefix.admin'). '.products.edit', $product['id']) }}" title="{{ trans('pakka::app.edit_title') }}">
								                <span class="ti-pencil"></span>
								            </a>
								            
			                                {!! Form::open([
			                                    'class'=>'delete',
			                                    'url'  => route(config('pakka.prefix.admin'). '.products.destroy', $product['id']), 
			                                    'method' => 'DELETE',
			                                    ]) 
			                                !!}
			
			                                	<button title="{{ trans('pakka::app.delete_title') }}">
			                                		<span class="ti-trash"></span>
			                                	</button>
			                                
											{!! Form::close() !!}
						                </div>
					                </div>
				                </div>
			                </div>
			            @endforeach
		            @else
		            	<p id="list-noresult">{{ trans('pakka::app.no_results') }}</p>
					@endif
				</div>
			</div>
	        @break
	@endswitch

@endsection