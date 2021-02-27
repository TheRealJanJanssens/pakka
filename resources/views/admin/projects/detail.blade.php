@extends('pakka::admin.default')

@section('page-header')
	{{ $project['name'] }} <small>{{ $project['id'] }}</small>
@stop

@section('content')
		
	<div class="row">
		<div class="col-sm-12">
			<div class="bgc-white p-20 mB-40 bd">
				
				<div id="progress-container">
					<div id="progress-head">
						<p>Je vooruitgang</p>
						<h2><span class="progress-percentage">0</span>% Voltooid</h2>
						<p class="progress-percentage-countdown">Nog <span>0</span>%</p>
					</div>
					<div id="progress-bar">
						<div id="progress">
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-6">
			<div class="bgc-white p-20 mB-40 bd">
				{{ $project['name'] }}
			</div>
		</div>
		
		<div class="col-sm-6">
			<div class="bgc-white p-20 mB-40 bd">
				
				<div id="rgbValue"></div>
				
			</div>
		</div>
	</div>
	
	<div id="task-detail">
	</div>
	
	<div id="task-detail-overlay">
	</div>
	
	<div class="container task-container task-container-fade task-container-editable" data-project="{{ $project['id'] }}"> <!-- turn on and of group adding with task-container-editable -->
		<div class="row d-flex container">
			
			@if(isset($tasks))
				@foreach($tasks as $group)
				    <div class="col-md-5 task-group task-group-position" data-project="{{ $project['id'] }}" data-group="{{ $group['id'] }}">
				        <div class="card-hover-shadow-2x card">
				            <div class="card-header-tab card-header">
				                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
					                <!-- <i class="fa fa-tasks"></i> -->
					                &nbsp;<b contenteditable="true">{{ $group['name'] }}</b>
					                
					                <div class="card-header-actions">
						                <div class="card-change-color">
							            	<i class="card-change-color-btn fa fa-paint-brush"></i>
						                </div>
						                
						                <i class="fa fa-chevron-left card-left"></i>
						                <div class="divider">•</div>
						                <i class="fa fa-chevron-right card-right"></i>
					                </div>
					                
					                <div class="card-header-border" @if(isset($group['color'])) style="background-color:{{ $group['color'] }};" @endif></div>
					                
					            </div>
				            </div>
				            <div class="scroll-area-xl"> <!-- Compact: scroll-area-sm -->
				                <perfect-scrollbar class="ps-show-limits">
				                    <div style="position: static;" class="ps ps--active-y">
				                        <div class="ps-content">
				                            <ul class=" list-group list-group-flush list-group-dropable"><!-- turn on and of soratble with list-group-dropable -->
												<li class="list-group-input">
													<input type="text" placeholder="{{ trans('pakka::app.add_task') }}">
													<span class="btn btn-primary btn-add-task"><i class="fa fa-plus"></i></span>
												</li>
												
												<li class="list-group-item-clone">
				                                    <div class="todo-indicator bg-neutral"></div>
				                                    <div class="widget-content p-0">
				                                        <div class="widget-content-wrapper">
				                                            <div class="widget-content-left mr-2">
				                                                <div class="custom-checkbox custom-control">
					                                                <i class="fa fa-check"></i>
				                                                </div>
				                                            </div>
				                                            <div class="widget-content-left widget-content-main">
				                                                <div class="widget-heading">
					                                                <span></span>
				                                                </div>
				                                                <div class="widget-subheading"><i>{{ auth()->user()->name }}</i></div>
				                                            </div>
				                                            <div class="widget-content-right"> 
					                                            <div class="handle"><i class="fa fa-arrows"></i></div>
				                                        </div>
				                                    </div>
				                                </li>
												
												@if(isset($group['tasks']))
													@foreach($group['tasks'] as $task)
													
													@switch($task['status'])
												    	@case(0)
															@php( $status = "" )
												        @break
												        	
												        @case(1)
															@php( $status = "done" )
												        @break
												    @endswitch
													
													<li class="list-group-item {{ $status }}" data-id="{{ $task['id'] }}">
														
														@switch($task['priority'])
													    	@case(0)
																@php( $prioBadge = "bg-neutral" )
													        @break
													        	
													        @case(1)
																@php( $prioBadge = "bg-succes" )
													        @break
													        
													        @case(2)
																@php( $prioBadge = "bg-warning" )
													        @break
													        
													        @case(3)
																@php( $prioBadge = "bg-error" )
													        @break
													    @endswitch
														
					                                    <div class="todo-indicator {{ $prioBadge }}"></div>
					                                    <div class="widget-content p-0">
					                                        <div class="widget-content-wrapper">
					                                            <div class="widget-content-left mr-2">
					                                                <div class="custom-checkbox custom-control">
						                                                <i class="fa fa-check"></i>
					                                                </div>
					                                            </div>
					                                            <div class="widget-content-left widget-content-main">
					                                                <div class="widget-heading">
						                                                <span>{{ $task['name'] }}</span>
	<!-- 					                                                <div class="badge badge-danger ml-2">Close deadline</div> -->
					                                                </div>
					                                                <div class="widget-subheading"><i>{{ $task['created_by'] }}</i></div>
					                                                
		<!--
					                                                <div class="widget-body">
						                                                <p>
						                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
					                                                </div>
		-->
					                                            </div>
					                                            <div class="widget-content-right"> 
						                                            <div class="handle"><i class="fa fa-arrows"></i></div>
					                                        </div>
					                                    </div>
					                                </li>
													@endforeach
												@endif
											</ul>
				                        </div>
				                    </div>
				                </perfect-scrollbar>
				            </div>
	<!-- 			            <div class="d-block text-right card-footer"><button class="mr-2 btn btn-link btn-sm">Cancel</button><button class="btn btn-primary">Add Task</button></div> -->
				        </div>
				    </div>
				@endforeach
			@endif
			<div class="col-md-5 task-group task-group-copy" data-project="{{ $project['id'] }}">
		        <div class="card-hover-shadow-2x card">
		            <div class="card-header-tab card-header">
		                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><!-- <i class="fa fa-tasks"></i> -->&nbsp;<b contenteditable="true">Voeg je titel toe...</b>
		                
			                <div class="card-header-actions">
				                <div class="card-change-color">
					            	<i class="card-change-color-btn fa fa-paint-brush"></i>
				                </div>
				                
				                <i class="fa fa-chevron-left card-left"></i>
				                <div class="divider">•</div>
				                <i class="fa fa-chevron-right card-right"></i>
			                </div>
			                
			                <div class="card-header-border" style="background-color: #fff;"></div>
		                </div>
		            </div>
		            <div class="scroll-area-sm">
		                <perfect-scrollbar class="ps-show-limits">
		                    <div style="position: static;" class="ps ps--active-y">
		                        <div class="ps-content">
		                            <ul class=" list-group list-group-flush list-group-dropable">
										<li class="list-group-input">
											<input type="text" placeholder="Voeg een taak toe...">
											<span class="btn btn-primary btn-add-task"><i class="fa fa-plus"></i></span>
										</li>
										
										<li class="list-group-item-clone">
		                                    <div class="todo-indicator bg-neutral"></div>
		                                    <div class="widget-content p-0">
		                                        <div class="widget-content-wrapper">
		                                            <div class="widget-content-left mr-2">
		                                                <div class="custom-checkbox custom-control">
			                                                <i class="fa fa-check"></i>
		                                                </div>
		                                            </div>
		                                            <div class="widget-content-left widget-content-main">
		                                                <div class="widget-heading">
			                                                <span></span>
		                                                </div>
		                                                <div class="widget-subheading"><i>{{ auth()->user()->name }}</i></div>
		                                            </div>
		                                            <div class="widget-content-right"> 
			                                            <div class="handle"><i class="fa fa-arrows"></i></div>
		                                        </div>
		                                    </div>
		                                </li>
									</ul>
		                        </div>
		                    </div>
		                </perfect-scrollbar>
		            </div>
<!-- 		            <div class="d-block text-right card-footer"><button class="mr-2 btn btn-link btn-sm">Cancel</button><button class="btn btn-primary">Add Task</button></div> -->
		        </div>
		    </div>
			
		</div>
	</div>
	
<!--
	<div class="row d-flex justify-content-center container">
	    <div class="col-md-8">
	        <div class="card-hover-shadow-2x mb-3 card">
	            <div class="card-header-tab card-header">
	                <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="fa fa-tasks"></i>&nbsp;Task Lists</div>
	            </div>
	            <div class="scroll-area-sm">
	                <perfect-scrollbar class="ps-show-limits">
	                    <div style="position: static;" class="ps ps--active-y">
	                        <div class="ps-content">
	                            <ul class=" list-group list-group-flush">
	                                <li class="list-group-item">
	                                    <div class="todo-indicator bg-warning"></div>
	                                    <div class="widget-content p-0">
	                                        <div class="widget-content-wrapper">
	                                            <div class="widget-content-left mr-2">
	                                                <div class="custom-checkbox custom-control"> <input class="custom-control-input" id="exampleCustomCheckbox12" type="checkbox"><label class="custom-control-label" for="exampleCustomCheckbox12">&nbsp;</label> </div>
	                                            </div>
	                                            <div class="widget-content-left">
	                                                <div class="widget-heading">Call Sam For payments <div class="badge badge-danger ml-2">Rejected</div>
	                                                </div>
	                                                <div class="widget-subheading"><i>By Bob</i></div>
	                                            </div>
	                                            <div class="widget-content-right"> <button class="border-0 btn-transition btn btn-outline-success"> <i class="fa fa-check"></i></button> <button class="border-0 btn-transition btn btn-outline-danger"> <i class="fa fa-trash"></i> </button> </div>
	                                        </div>
	                                    </div>
	                                </li>
	                                <li class="list-group-item">
	                                    <div class="todo-indicator bg-focus"></div>
	                                    <div class="widget-content p-0">
	                                        <div class="widget-content-wrapper">
	                                            <div class="widget-content-left mr-2">
	                                                <div class="custom-checkbox custom-control"><input class="custom-control-input" id="exampleCustomCheckbox1" type="checkbox"><label class="custom-control-label" for="exampleCustomCheckbox1">&nbsp;</label></div>
	                                            </div>
	                                            <div class="widget-content-left">
	                                                <div class="widget-heading">Make payment to Bluedart</div>
	                                                <div class="widget-subheading">
	                                                    <div>By Johnny <div class="badge badge-pill badge-info ml-2">NEW</div>
	                                                    </div>
	                                                </div>
	                                            </div>
	                                            <div class="widget-content-right"> <button class="border-0 btn-transition btn btn-outline-success"> <i class="fa fa-check"></i></button> <button class="border-0 btn-transition btn btn-outline-danger"> <i class="fa fa-trash"></i> </button> </div>
	                                        </div>
	                                    </div>
	                                </li>
	                                <li class="list-group-item">
	                                    <div class="todo-indicator bg-primary"></div>
	                                    <div class="widget-content p-0">
	                                        <div class="widget-content-wrapper">
	                                            <div class="widget-content-left mr-2">
	                                                <div class="custom-checkbox custom-control"><input class="custom-control-input" id="exampleCustomCheckbox4" type="checkbox"><label class="custom-control-label" for="exampleCustomCheckbox4">&nbsp;</label></div>
	                                            </div>
	                                            <div class="widget-content-left flex2">
	                                                <div class="widget-heading">Office rent </div>
	                                                <div class="widget-subheading">By Samino!</div>
	                                            </div>
	                                            <div class="widget-content-right"> <button class="border-0 btn-transition btn btn-outline-success"> <i class="fa fa-check"></i></button> <button class="border-0 btn-transition btn btn-outline-danger"> <i class="fa fa-trash"></i> </button> </div>
	                                        </div>
	                                    </div>
	                                </li>
	                                <li class="list-group-item">
	                                    <div class="todo-indicator bg-info"></div>
	                                    <div class="widget-content p-0">
	                                        <div class="widget-content-wrapper">
	                                            <div class="widget-content-left mr-2">
	                                                <div class="custom-checkbox custom-control"><input class="custom-control-input" id="exampleCustomCheckbox2" type="checkbox"><label class="custom-control-label" for="exampleCustomCheckbox2">&nbsp;</label></div>
	                                            </div>
	                                            <div class="widget-content-left">
	                                                <div class="widget-heading">Office grocery shopping</div>
	                                                <div class="widget-subheading">By Tida</div>
	                                            </div>
	                                            <div class="widget-content-right"> <button class="border-0 btn-transition btn btn-outline-success"> <i class="fa fa-check"></i></button> <button class="border-0 btn-transition btn btn-outline-danger"> <i class="fa fa-trash"></i> </button> </div>
	                                        </div>
	                                    </div>
	                                </li>
	                                <li class="list-group-item">
	                                    <div class="todo-indicator bg-success"></div>
	                                    <div class="widget-content p-0">
	                                        <div class="widget-content-wrapper">
	                                            <div class="widget-content-left mr-2">
	                                                <div class="custom-checkbox custom-control"><input class="custom-control-input" id="exampleCustomCheckbox3" type="checkbox"><label class="custom-control-label" for="exampleCustomCheckbox3">&nbsp;</label></div>
	                                            </div>
	                                            <div class="widget-content-left flex2">
	                                                <div class="widget-heading">Ask for Lunch to Clients</div>
	                                                <div class="widget-subheading">By Office Admin</div>
	                                            </div>
	                                            <div class="widget-content-right"> <button class="border-0 btn-transition btn btn-outline-success"> <i class="fa fa-check"></i></button> <button class="border-0 btn-transition btn btn-outline-danger"> <i class="fa fa-trash"></i> </button> </div>
	                                        </div>
	                                    </div>
	                                </li>
	                                <li class="list-group-item">
	                                    <div class="todo-indicator bg-success"></div>
	                                    <div class="widget-content p-0">
	                                        <div class="widget-content-wrapper">
	                                            <div class="widget-content-left mr-2">
	                                                <div class="custom-checkbox custom-control"><input class="custom-control-input" id="exampleCustomCheckbox10" type="checkbox"><label class="custom-control-label" for="exampleCustomCheckbox10">&nbsp;</label></div>
	                                            </div>
	                                            <div class="widget-content-left flex2">
	                                                <div class="widget-heading">Client Meeting at 11 AM</div>
	                                                <div class="widget-subheading">By CEO</div>
	                                            </div>
	                                            <div class="widget-content-right"> <button class="border-0 btn-transition btn btn-outline-success"> <i class="fa fa-check"></i></button> <button class="border-0 btn-transition btn btn-outline-danger"> <i class="fa fa-trash"></i> </button> </div>
	                                        </div>
	                                    </div>
	                                </li>
	                            </ul>
	                        </div>
	                    </div>
	                </perfect-scrollbar>
	            </div>
	            <div class="d-block text-right card-footer"><button class="mr-2 btn btn-link btn-sm">Cancel</button><button class="btn btn-primary">Add Task</button></div>
	        </div>
	    </div>
	</div>
-->
	
@stop
