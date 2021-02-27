<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 mB-20 bd">
			@foreach ($lang as $langItem)
				{!! Form::myInput('text', 'name', 'Naam', ["data-slugify" => "true", "data-output" => "slug"], isset($collection) ? stripslashes($collection[$langItem["language_code"].":name"]) : null, $langItem["language_code"]) !!}
				
				{!! Form::myTextArea('description', 'Omschrijving', [], null, $langItem["language_code"]) !!}

			@endforeach
		</div>
		
		<div class="input-tabs" data-name="type">
			<div class="bgc-white p-20 mB-20 bd">
				<p class="mB-20"><b>{{ trans('pakka::app.col_type') }}</b></p>
				
				<?php
					$value = 1;
					$checked = true;
					if( isset($collection['type']) ){
						if($collection['type'] == $value){
							$checked = true;
						}else{
							$checked = false;
						}
					}
				?>
				
				{!! Form::myRadio('type', '<b>'.trans("pakka::app.man_col").'</b>', $value, null, $checked, [], 'col-sm-6 col-md-4 mB-10') !!}
				<p class="mL-30">{{ trans('pakka::app.man_col_desc') }}</p>
				<hr>
				
				<?php
					$value = 2;
					$checked = false;
					if( isset($collection['type']) ){
						if($collection['type'] == $value){
							$checked = true;
						}
					}
				?>
				
				{!! Form::myRadio('type', '<b>'.trans("pakka::app.auto_col").'</b>', $value, null, $checked, [], 'col-sm-6 col-md-4 mB-10') !!}
				<p class="mL-30">{{ trans('pakka::app.auto_col_desc') }}</p>
			</div><!-- end second container -->
			  
			<div class="bgc-white p-20 bd">
				<div class="input-tab-list">
					<div class="input-tab-item" data-id="1">
						<p class="mB-20"><b>{{ trans('pakka::app.products') }}</b></p>
						<div class="bgc-white p-20 mB-20 bd">
							
						</div>
					</div>
					
					<div class="input-tab-item" data-id="2">
						<p class="mB-20"><b>{{ trans('pakka::app.conditions') }}</b></p>
						
						<div class="container mB-5">
							<div class="row">
								<p class="mB-0 mR-20">{{ trans("pakka::app.match_conditions") }}:</p>
								
								<?php
									//dd($collection);
									$value = 1;
									$checked = true;
									if( isset($collection['match']) ){
										if($collection['match'] == $value){
											$checked = true;
										}
									}
								?>
								
								{!! Form::myRadio('match', trans("pakka::app.all_conditions"), 1, null, $checked, [], 'mR-10') !!}
								<?php
									$value = 2;
									$checked = false;
									if( isset($collection['match']) ){
										if($collection['match'] == $value){
											$checked = true;
										}
									}
								?>
								
								{!! Form::myRadio('match', trans("pakka::app.any_conditions"), 2, null, $checked, [], '') !!}
							</div>
						</div>
						
						<table class="table table-form table-tagsinput" cellspacing="0">
						    <tbody>
							    
							    <tr class="table-form-template">
								    <td width="25%" class="pL-0">
						                <?php
							                $inputs = [
								            	"name" => trans('pakka::app.name'),
								            	"description" => trans('pakka::app.description'),  
							                ];
						                ?>
			
										{!! Form::mySelect('input[]', null, $inputs, null, ['class' => 'form-control select2', 'data-search' => '-1']) !!}
							        </td>
							        
						            <td width="25%">
							            <?php
							                $operators = [
								            	"1" => trans('pakka::app.equal'),
								            	"2" => trans('pakka::app.not_equal'),
								            	"3" => trans('pakka::app.starts_with'),
								            	"4" => trans('pakka::app.ends_with'),
								            	"5" => trans('pakka::app.contains'),
								            	"6" => trans('pakka::app.doesnt_contain'),  
							                ];
						                ?>
			
										{!! Form::mySelect('operator[]', null, $operators, null, ['class' => 'form-control select2', 'data-search' => '-1']) !!}
							        </td>
									
									<td>
								        @foreach($lang as $langItem)
											{!! Form::myInput('text', 'string[]', null, [], null, $langItem["language_code"]) !!}
										@endforeach
							        </td>
							        
							        <td width="63px" class="pR-0">
				                        <a class="btn btn-danger table-form-remove" href="#"><i class="ti-trash"></i></a>
				                    </td>						            
						        </tr>
						        
						        @if(isset($collection['conditions']))
									@foreach($collection['conditions'] as $condition)
										<tr>
										    <td width="25%" class="pL-0">					
												{!! Form::mySelect('input[]', null, $inputs, $condition['input'], ['class' => 'form-control select2', 'data-search' => '-1']) !!}
									        </td>
									        
								            <td width="25%">
												{!! Form::mySelect('operator[]', null, $operators, $condition['operator'], ['class' => 'form-control select2', 'data-search' => '-1']) !!}
									        </td>
											
											<td>
												@foreach($lang as $langItem)
													@php($langCode = $langItem["language_code"])
													@php($insert[0] = $condition[$langCode.':string'])
													@php($insert[1] = $condition['translation_id']['string'])
													{!! Form::myInput('text', 'string[]', null, [], $insert, $langCode) !!}
												@endforeach
									        </td>
									        
									        <td width="63px" class="pR-0">
						                        <a class="btn btn-danger table-form-remove" href="#"><i class="ti-trash"></i></a>
						                    </td>        
										</tr>
										
									@endforeach
						        @endif
						        
						    </tbody>
						</table>
						<span class="text-primary table-form-add"><i class="ti-plus"></i> Voeg conditie toe</span>
					</div>
				</div>
			</div><!-- ends third container -->
		</div><!-- ends input tabs -->
		  
	</div>

	<div class="col-sm-4">
		<div class="bgc-white p-20 mB-20 bd">
			<p><b>{{ trans('pakka::app.settings') }}:</b></p>
			@foreach($lang as $langItem)
				{!! Form::myInput('text', 'slug', null, ["class" => "form-control slug-input"], null, $langItem["language_code"]) !!}
		@endforeach
			
			<div class="list-group list-group-status">
				
				@if (isset($product['status']))
					@switch($product['status'])
				    	@case(1)
							@php( $onlineClass = "active" )
							@php( $offlineClass = "" )
				        @break
				        	
				        @case(0)
							@php( $onlineClass = "" )
							@php( $offlineClass = "active" )
				        @break
				    @endswitch
				@else    
				    @php( $onlineClass = "active" )
					@php( $offlineClass = "" )
				@endif
								
				<a href="#" class="list-group-item list-group-item-action list-group-head {{ $onlineClass }}" data-status="1">{{ trans('pakka::app.active') }}</a>
				<a href="#" class="list-group-item list-group-item-action {{ $offlineClass }}" data-status="0">{{ trans('pakka::app.not_active') }}</a>
			</div>
			{!! Form::myInput('hidden', 'status', '', ["class" => "status-input"]) !!}
			
		</div>
		
		{{ constructTransSelect() }}
		
		<button type="submit" class="btn btn-primary-gradient">{{ trans('pakka::app.save_button') }}</button>
	</div>
</div>