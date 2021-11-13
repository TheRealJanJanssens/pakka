@extends('pakka::admin.default')

@section('page-header')
	{{ trans('pakka::app.content') }} <!-- <small>{{ trans('pakka::app.new') }}</small> -->
@stop

@section('content')

	<div class="action-bar mB-20 ">
        @if(checkAccess("permission_content_edit"))
			<a href="{{ route(config('pakka.prefix.admin'). '.content.createpage') }}" class="btn btn-info">
		        {{ trans('pakka::app.page') }} {{ trans('pakka::app.add_button') }}
		    </a>
	    @endif

		@if(checkAccess())
			<a href="{{ route(config('pakka.prefix.admin'). '.sectionmanager.index') }}" class="btn btn-info">
		        {{ trans('pakka::app.section_manager') }}
		    </a>
	    @endif
	    
	    <a href="/" class="btn btn-info">
	        {{ trans('pakka::app.go_to') }} {{ trans('pakka::app.live_editor') }}
	    </a>
    </div>
	
	<div class="table-container bgc-white bd bdrs-3 p-20 mB-20">
        <table class="table table-list table-accordion table-sort" cellspacing="0" width="100%"> <!-- table-striped  id="dataTable" table-bordered-->
            <thead>
                <tr>
                    <th>{{ trans('pakka::app.name') }}</th>
                    <th></th>
                </tr>
            </thead>
           
            <tbody data-action="/admin/content/order/sections">
	            @if (!empty($pages))
	            
	                @foreach ($pages as $page)
	                    <tr class="head" data-head="{{ $page->id }}">
	                        <td><b>{{ $page->name }}</b></td>
	                        <td>
	                            <ul class="list-inline">
		                            
		                            @if(checkAccess("permission_content_edit"))

										@if(checkAccess("permission_template_managment"))
										<li class="list-inline-item">
											<a href="{{ route(config('pakka.prefix.admin'). '.content.generatetemplate', [$page->id]) }}" title="{{ trans('pakka::app.generate_template') }}" class="btn btn-secondary btn-sm"><span class="ti-hummer"></span></a></li>
										@endif

			                            <li class="list-inline-item">
											<a href="{{ route(config('pakka.prefix.admin'). '.content.createsection', $page->id) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-secondary btn-sm"><span class="ti-plus"></span></a></li>
											
		                                <li class="list-inline-item">
		                                    <a href="{{ route(config('pakka.prefix.admin'). '.content.editpage', $page->id) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
		                                    
		                                <li class="list-inline-item">
		                                    {!! Form::open([
		                                        'class'=>'delete',
		                                        'url'  => route(config('pakka.prefix.admin'). '.content.destroypage', $page->id), 
		                                        'method' => 'DELETE',
		                                        ]) 
		                                    !!}
		
		                                        <button class="btn btn-danger btn-sm" title="{{ trans('pakka::app.delete_title') }}"><i class="ti-trash"></i></button>
		                                        
		                                    {!! Form::close() !!}
		                                </li>
	                                @endif
	                                <li class="list-inline-item">
	                                	<i class="ti-angle-left arrow"></i>
	                                </li>
	                            </ul>
	                        </td>
	                    </tr>
	                    
	                    @foreach ($page['sections'] as $section)
		                    
		                    	<tr class="item hidden" data-head="{{ $page->id }}" data-subitem="{{ $section->id }}" data-id="{{ $section->id }}" data-level="1" data-position="">
			                        <td><i class="handle ti-line-double"></i><b>{{ $section->name }}</b></td>
			                        <td>
			                            <ul class="list-inline">
				                            @if(checkAccess("permission_content_edit"))
					                            <li class="list-inline-item">
				                                    <a href="{{ route(config('pakka.prefix.admin'). '.content.createcomponent', [$page->id,$section->id]) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-secondary btn-sm"><span class="ti-plus"></span></a></li>
				                                    
				                                <li class="list-inline-item">
				                                    <a href="{{ route(config('pakka.prefix.admin'). '.content.editsection', [$section->id, $page->id]) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
				                                <li class="list-inline-item">
				                                    {!! Form::open([
				                                        'class'=>'delete',
				                                        'url'  => route(config('pakka.prefix.admin'). '.content.destroysection', $section->id), 
				                                        'method' => 'DELETE',
				                                        ]) 
				                                    !!}
				
				                                        <button class="btn btn-danger btn-sm" title="{{ trans('pakka::app.delete_title') }}"><i class="ti-trash"></i></button>
				                                        
				                                    {!! Form::close() !!}
				                                </li>
			                                @endif
			                                
			                                <li class="list-inline-item">
			                                	<i class="ti-angle-left arrow"></i>
			                                </li>
			                            </ul>
			                        </td>
			                    </tr>
			                    
								@foreach ($section['components'] as $component)
		                    
				                    	<tr class="item hidden" data-head="{{ $page->id }}" data-subitem="{{ $section->id }}" data-component="{{ $component->id }}" data-level="2">
					                        <td><p>{{ $component->name }}</p></td>
					                        <td>
					                            <ul class="list-inline">

						                            <li class="list-inline-item">
						                                <a href="{{ route(config('pakka.prefix.admin'). '.content.editcontent', $component->id) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil-alt"></span></a></li>
						                            
						                            @if(checkAccess("permission_input_edit"))
							                            <li class="list-inline-item">
						                                    <a href="{{ route(config('pakka.prefix.admin'). '.inputs.index', $component->id) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-secondary btn-sm"><span class="ti-view-list"></span></a></li>
						                            @endif
						                            
						                            @if(checkAccess("permission_content_edit"))
						                                <li class="list-inline-item">
						                                    <a href="{{ route(config('pakka.prefix.admin'). '.content.editcomponent', [$component->id,$page->id,$section->id]) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
						                                <li class="list-inline-item">
						                                    {!! Form::open([
						                                        'class'=>'delete',
						                                        'url'  => route(config('pakka.prefix.admin'). '.content.destroycomponent', $component->id), 
						                                        'method' => 'DELETE',
						                                        ]) 
						                                    !!}
						
						                                        <button class="btn btn-danger btn-sm" title="{{ trans('pakka::app.delete_title') }}"><i class="ti-trash"></i></button>
						                                        
						                                    {!! Form::close() !!}
						                                </li>
					                                @endif
					                            </ul>
					                        </td>
					                    </tr>
	
								@endforeach
						@endforeach
			            
	                @endforeach
                
                @else
	            	<tr id="list-noresult"><td colspan="3">{{ trans('pakka::app.no_results') }}</td></tr>
				@endif
            </tbody>
        
        </table>
    </div>

	
@stop
