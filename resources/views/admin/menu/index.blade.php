@extends('pakka::admin.default')

@section('page-header')
    Menu <small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')
	
    <div class="mB-20">
	    @if(checkAccess("permission_add_menus"))
	        <a href="{{ route(config('pakka.prefix.admin').'.menu.createmenu') }}" class="btn btn-info">
	            Menu {{ trans('pakka::app.add_button') }}
	        </a>
        @endif
        
        <a href="{{ route(config('pakka.prefix.admin').'.menu.createmenuitem') }}" class="btn btn-info">
            Menu item {{ trans('pakka::app.add_button') }}
        </a>
    </div>


    <div class="table-container bgc-white bd bdrs-3 p-20 mB-20">
        <table class="table table-list table-menu table-sort" cellspacing="0" width="100%"> <!-- table-striped  id="dataTable" table-bordered-->
            <thead>
                <tr>
                    <th>{{ trans('pakka::app.name') }}</th>
                    <th></th>
                </tr>
            </thead>
            
            <tbody data-action="/admin/menu/sort">
                @foreach ($menus as $menu)
                    <tr class="head" data-menu="{{ $menu['id'] }}">
                        <td><a href="{{ route(config('pakka.prefix.admin').'.menu.editmenu', $menu['id']) }}">{{ $menu['name'] }}</a></td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(config('pakka.prefix.admin').'.menu.editmenu', $menu['id']) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(config('pakka.prefix.admin').'.menu.destroymenu', $menu['id']), 
                                        'method' => 'DELETE',
                                        ]) 
                                    !!}

                                        <button class="btn btn-danger btn-sm" title="{{ trans('pakka::app.delete_title') }}"><i class="ti-trash"></i></button>
                                        
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
                    
                    <?php //$menuItems = constructMenu($menu['id']); ?>
                    
                    @foreach ($menu['items'] as $item)
	                    
	                    	<tr class="item" data-id="{{ $item['id'] }}" data-menu="{{ $menu['id'] }}" data-level="1" data-position="" data-parent="{{ $item['parent'] }}">
		                        <td><i class="handle ti-line-double"></i><a href="{{ route(config('pakka.prefix.admin').'.menu.editmenuitem', $item['id']) }}">{{ $item['name'] }}</a></td>
		                        <td>
		                            <ul class="list-inline">
		                                <li class="list-inline-item">
		                                    <a href="{{ route(config('pakka.prefix.admin').'.menu.editmenuitem', $item['id']) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
		                                <li class="list-inline-item">
		                                    {!! Form::open([
		                                        'class'=>'delete',
		                                        'url'  => route(config('pakka.prefix.admin').'.menu.destroymenuitem', $item['id']), 
		                                        'method' => 'DELETE',
		                                        ]) 
		                                    !!}
		
		                                        <button class="btn btn-danger btn-sm" title="{{ trans('pakka::app.delete_title') }}"><i class="ti-trash"></i></button>
		                                        
		                                    {!! Form::close() !!}
		                                </li>
		                            </ul>
		                        </td>
		                    </tr>
		                    
		                    @if (isset($item['items']))
		                    	
				                    @foreach ($item['items'] as $lvlTwoItem)
			                    
				                    	<tr class="item" data-id="{{ $lvlTwoItem['id'] }}" data-menu="{{ $menu['id'] }}" data-level="2" data-position="" data-parent="{{ $lvlTwoItem['parent'] }}">
					                        <td><i class="handle ti-line-double"></i><a href="{{ route(config('pakka.prefix.admin').'.menu.editmenuitem', $lvlTwoItem['id']) }}">{{ $lvlTwoItem['name'] }}</a></td>
					                        <td>
					                            <ul class="list-inline">
					                                <li class="list-inline-item">
					                                    <a href="{{ route(config('pakka.prefix.admin').'.menu.editmenuitem', $lvlTwoItem['id']) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
					                                <li class="list-inline-item">
					                                    {!! Form::open([
					                                        'class'=>'delete',
					                                        'url'  => route(config('pakka.prefix.admin').'.menu.destroymenuitem', $lvlTwoItem['id']), 
					                                        'method' => 'DELETE',
					                                        ]) 
					                                    !!}
					
					                                        <button class="btn btn-danger btn-sm" title="{{ trans('pakka::app.delete_title') }}"><i class="ti-trash"></i></button>
					                                        
					                                    {!! Form::close() !!}
					                                </li>
					                            </ul>
					                        </td>
					                    </tr>
					                    
					                    @if (isset($lvlTwoItem['items']))
					                    	
							                    @foreach ($lvlTwoItem['items'] as $lvlThreeItem)
						                    
							                    	<tr class="item" data-id="{{ $lvlThreeItem['id'] }}" data-menu="{{ $menu['id'] }}" data-level="3" data-position="" data-parent="{{ $lvlThreeItem['parent'] }}">
								                        <td><i class="handle ti-line-double"></i><a href="{{ route(config('pakka.prefix.admin').'.menu.editmenuitem', $lvlThreeItem['id']) }}">{{ $lvlThreeItem['name'] }}</a></td>
								                        <td>
								                            <ul class="list-inline">
								                                <li class="list-inline-item">
								                                    <a href="{{ route(config('pakka.prefix.admin').'.menu.editmenuitem', $lvlThreeItem['id']) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
								                                <li class="list-inline-item">
								                                    {!! Form::open([
								                                        'class'=>'delete',
								                                        'url'  => route(config('pakka.prefix.admin').'.menu.destroymenuitem', $lvlThreeItem['id']), 
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
												<!-- END THIRD LVL -->
					                    @endif
					                    
									@endforeach
									<!-- END SECOND LVL -->
		                    @endif
		                    <!-- END FIRST LVL -->    
					@endforeach
                    
                @endforeach
            </tbody>
        
        </table>
    </div>

@endsection