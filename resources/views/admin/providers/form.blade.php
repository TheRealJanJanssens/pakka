<div class="row mB-40">
	<div class="col-sm-12">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'name', 'Naam') !!}
	
			@php($users = App\User::constructSelect(0))
			
			{!! Form::mySelect('user_id', 'Gebruiker', $users, null, ['class' => 'form-control select2']) !!}
			
			@switch($settings['booking_type'])
			    @case(1)
			        
			        <table class="table table-bordered table-rounded table-form table-datepicker" cellspacing="0">
					    <thead>
					        <tr>
					            <th>{{ trans('pakka::app.days.mon') }}</th>
					            <th>{{ trans('pakka::app.days.tue') }}</th>
					            <th>{{ trans('pakka::app.days.wed') }}</th>
					            <th>{{ trans('pakka::app.days.thu') }}</th>
					            <th>{{ trans('pakka::app.days.fri') }}</th>
					            <th>{{ trans('pakka::app.days.sat') }}</th>
					            <th>{{ trans('pakka::app.days.sun') }}</th>
					            <th>Start</th>
					            <th>End</th>
					            <th></th>
					        </tr>
					    </thead>
					    <tbody>
						    
						    <tr class="table-form-template">
					            <td>
						            <div class="checkbox checkbox-circle checkbox-info peers ai-c checkbox--single">
							            <input data-name="schedule[][id]" type="hidden" value="0">
							            <input data-name="schedule[][mon]" type="hidden" value="0">
							            <input id="schedule[][mon]" data-name="schedule[][mon]" type="checkbox" value="1">
							            <label for="schedule[][mon]" class="peers peer-greed js-sb ai-c">
							                <span class="peer peer-greed"></span>
							            </label>
							        </div>
					            </td>
					            
					            <td>
						            <div class="checkbox checkbox-circle checkbox-info peers ai-c checkbox--single">
							            <input data-name="schedule[][tue]" type="hidden" value="0">
							            <input id="schedule[][tue]" data-name="schedule[][tue]" type="checkbox" value="1">
							            <label for="schedule[][tue]" class="peers peer-greed js-sb ai-c">
							                <span class="peer peer-greed"></span>
							            </label>
							        </div>
					            </td>
					            
					            <td>
						            <div class="checkbox checkbox-circle checkbox-info peers ai-c checkbox--single">
							            <input data-name="schedule[][wed]" type="hidden" value="0">
							            <input id="schedule[][wed]" data-name="schedule[][wed]" type="checkbox" value="1">
							            <label for="schedule[][wed]" class="peers peer-greed js-sb ai-c">
							                <span class="peer peer-greed"></span>
							            </label>
							        </div>
					            </td>
					            
					            <td>
						            <div class="checkbox checkbox-circle checkbox-info peers ai-c checkbox--single">
							            <input data-name="schedule[][thu]" type="hidden" value="0">
							            <input id="schedule[][thu]" data-name="schedule[][thu]" type="checkbox" value="1">
							            <label for="schedule[][thu]" class="peers peer-greed js-sb ai-c">
							                <span class="peer peer-greed"></span>
							            </label>
							        </div>
					            </td>
					            
					            <td>
						            <div class="checkbox checkbox-circle checkbox-info peers ai-c checkbox--single">
							            <input data-name="schedule[][fri]" type="hidden" value="0">
							            <input id="schedule[][fri]" data-name="schedule[][fri]" type="checkbox" value="1">
							            <label for="schedule[][fri]" class="peers peer-greed js-sb ai-c">
							                <span class="peer peer-greed"></span>
							            </label>
							        </div>
					            </td>
					            
					            <td>
						            <div class="checkbox checkbox-circle checkbox-info peers ai-c checkbox--single">
							            <input data-name="schedule[0][sat]" type="hidden" value="0">
							            <input id="schedule[][sat]" data-name="schedule[][sat]" type="checkbox" value="1">
							            <label for="schedule[][sat]" class="peers peer-greed js-sb ai-c">
							                <span class="peer peer-greed"></span>
							            </label>
							        </div>
					            </td>
					            
					            <td>
						            <div class="checkbox checkbox-circle checkbox-info peers ai-c checkbox--single">
							            <input data-name="schedule[0][sun]" type="hidden" value="0">
							            <input id="schedule[][sun]" data-name="schedule[][sun]" type="checkbox" value="1">
							            <label for="schedule[][sun]" class="peers peer-greed js-sb ai-c">
							                <span class="peer peer-greed"></span>
							            </label>
							        </div>
					            </td>
					            
					            <td>
					                <div class="input-group start-time">
										<input type="text" data-name="schedule[][start_at]" class="form-control">
										
										<div class="input-group-append">
											<span class="input-group-text input-group-addon"><i class="far fa-clock"></i></span>
										</div>
									</div>
						        </td>
						        
					            <td>
						            <div class="input-group end-time">
										<input type="text" data-name="schedule[][end_at]" class="form-control">
										
										<div class="input-group-append">
											<span class="input-group-text input-group-addon"><i class="far fa-clock"></i></span>
										</div>
									</div>
						        </td>
						        
					            <td class="text-center">
			                        <i class="ti-more-alt" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
			                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
				                        <a class="dropdown-item table-form-duplicate schedule-item-duplicate" href="#"><i class="ti-layers mR-10"></i>Dupliceren</a>
				                        <a class="dropdown-item table-form-remove schedule-item-remove text-danger" href="#"><i class="ti-trash mR-10"></i>Verwijderen</a>
				                    </div>
			                    </td>
					        </tr>
						    
						    @if(!empty($provider['schedule']))
						    	@foreach($provider['schedule'] as $item)
						    	
						    	<tr>
						            <td>
							            <div class="checkbox checkbox-circle checkbox-info peers ai-c checkbox--single">
								            <input name="schedule[][id]" type="hidden" value="{{ $item['id'] }}">
								            <input name="schedule[][mon]" type="hidden" value="0">
								            <input id="schedule[][mon]" name="schedule[][mon]" type="checkbox" value="1" {{  ($item['mon'] == 1 ? ' checked' : '') }}>
								            <label for="schedule[][mon]" class="peers peer-greed js-sb ai-c">
								                <span class="peer peer-greed"></span>
								            </label>
								        </div>
						            </td>
						            
						            <td>
							            <div class="checkbox checkbox-circle checkbox-info peers ai-c checkbox--single">
								            <input name="schedule[][tue]" type="hidden" value="0">
								            <input id="schedule[][tue]" name="schedule[][tue]" type="checkbox" value="1" {{  ($item['tue'] == 1 ? ' checked' : '') }}>
								            <label for="schedule[][tue]" class="peers peer-greed js-sb ai-c">
								                <span class="peer peer-greed"></span>
								            </label>
								        </div>
						            </td>
						            
						            <td>
							            <div class="checkbox checkbox-circle checkbox-info peers ai-c checkbox--single">
								            <input name="schedule[][wed]" type="hidden" value="0">
								            <input id="schedule[][wed]" name="schedule[][wed]" type="checkbox" value="1" {{  ($item['wed'] == 1 ? ' checked' : '') }}>
								            <label for="schedule[][wed]" class="peers peer-greed js-sb ai-c">
								                <span class="peer peer-greed"></span>
								            </label>
								        </div>
						            </td>
						            
						            <td>
							            <div class="checkbox checkbox-circle checkbox-info peers ai-c checkbox--single">
								            <input name="schedule[][thu]" type="hidden" value="0">
								            <input id="schedule[][thu]" name="schedule[][thu]" type="checkbox" value="1" {{  ($item['thu'] == 1 ? ' checked' : '') }}>
								            <label for="schedule[][thu]" class="peers peer-greed js-sb ai-c">
								                <span class="peer peer-greed"></span>
								            </label>
								        </div>
						            </td>
						            
						            <td>
							            <div class="checkbox checkbox-circle checkbox-info peers ai-c checkbox--single">
								            <input name="schedule[][fri]" type="hidden" value="0">
								            <input id="schedule[][fri]" name="schedule[][fri]" type="checkbox" value="1" {{  ($item['fri'] == 1 ? ' checked' : '') }}>
								            <label for="schedule[][fri]" class="peers peer-greed js-sb ai-c">
								                <span class="peer peer-greed"></span>
								            </label>
								        </div>
						            </td>
						            
						            <td>
							            <div class="checkbox checkbox-circle checkbox-info peers ai-c checkbox--single">
								            <input name="schedule[][sat]" type="hidden" value="0">
								            <input id="schedule[][sat]" name="schedule[][sat]" type="checkbox" value="1" {{  ($item['sat'] == 1 ? ' checked' : '') }}>
								            <label for="schedule[][sat]" class="peers peer-greed js-sb ai-c">
								                <span class="peer peer-greed"></span>
								            </label>
								        </div>
						            </td>
						            
						            <td>
							            <div class="checkbox checkbox-circle checkbox-info peers ai-c checkbox--single">
								            <input name="schedule[][sun]" type="hidden" value="0">
								            <input id="schedule[][sun]" name="schedule[][sun]" type="checkbox" value="1" {{  ($item['sun'] == 1 ? ' checked' : '') }}>
								            <label for="schedule[][sun]" class="peers peer-greed js-sb ai-c">
								                <span class="peer peer-greed"></span>
								            </label>
								        </div>
						            </td>
						            
						            <td>
						                <div class="input-group start-time">
											<input type="text" name="schedule[][start_at]" class="form-control" value="{{ $item['start_at'] }}">
											
											<div class="input-group-append">
												<span class="input-group-text input-group-addon"><i class="far fa-clock"></i></span>
											</div>
										</div>
							        </td>
							        
						            <td>
							            <div class="input-group end-time">
											<input type="text" name="schedule[][end_at]" class="form-control" value="{{ $item['end_at'] }}">
											
											<div class="input-group-append">
												<span class="input-group-text input-group-addon"><i class="far fa-clock"></i></span>
											</div>
										</div>
							        </td>
							        
						            <td class="text-center">
				                        <i class="ti-more-alt" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
				                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
					                        <a class="dropdown-item table-form-duplicate schedule-item-duplicate" href="#"><i class="ti-layers mR-10"></i>Dupliceren</a>
					                        <a class="dropdown-item table-form-remove schedule-item-remove text-danger" href="#"><i class="ti-trash mR-10"></i>Verwijderen</a>
					                    </div>
				                    </td>
						        </tr>
						    	
						    	@endforeach
						    @endif
						    
					        
					    </tbody>
					    
					    <tfoot>
						    <tr class="text-center">
					            <td colspan="100%">
						            <span class="btn btn-primary table-form-add schedule-item-add">+ Voeg een tijdschema toe</span>
						        </td>
					        </tr>
					    </tfoot>
					</table>
			        
			        @break
			
			    @case(2)
			    
			        {!! Form::myInput('number', 'capacity', 'Capaciteit', []) !!}
			        
			        @break
			@endswitch
				
		</div>  
		
		<button type="submit" class="btn btn-primary-gradient mT-20">{{ trans('pakka::app.save_button') }}</button>
		
	</div>
</div>