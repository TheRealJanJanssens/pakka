<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 mB-20 bd">
			@foreach ($lang as $langItem)
				{!! Form::myInput('text', 'name', 'Naam', [], null, $langItem["language_code"]) !!}
			@endforeach
			
			{!! Form::myPrice('price', 'Prijs') !!}
			
			<?php
                //Translates all the condition operators
				$delivery = translateConfigArray("pakka.shipment_delivery");
            ?>

			{!! Form::mySelect('delivery', 'Soort levering', $delivery, null, ['class' => 'form-control select2', 'data-search' => '-1']) !!}
			
			<?php
                //Translates all the condition operators
				$carriers = translateConfigArray("pakka.shipment_carrier");
            ?>

			{!! Form::mySelect('carrier', 'Koerier', $carriers, null, ['class' => 'form-control select2', 'data-search' => '-1']) !!}
				
			<?php
                //Translates all the condition operators
				$region = translateConfigArray("pakka.regions");
            ?>

			{!! Form::mySelect('region', 'Regio', $region, null, ['class' => 'form-control select2', 'data-search' => '-1']) !!}
			
			@foreach ($lang as $langItem)
				{!! Form::myTextArea('description', 'Omschrijving', [], null, $langItem["language_code"]) !!}
			@endforeach
		</div>
		  
		<div class="bgc-white p-20 bd">
			<p class="mB-20"><b>{{ trans('pakka::app.conditions') }}</b></p>
			
			<div class="container mB-5">
				<div class="row">
					<p class="mB-0 mR-20">{{ trans("pakka::app.match_conditions") }}:</p>
					
					<?php
						$value = 1;
						$checked = true;
						if( isset($shipment['match']) ){
							if($shipment['match'] == $value){
								$checked = true;
							}
						}
					?>
					
					{!! Form::myRadio('match', trans("pakka::app.all_conditions"), 1, null, $checked, [], 'mR-20') !!}
					<?php
						$value = 2;
						$checked = false;
						if( isset($shipment['match']) ){
							if($shipment['match'] == $value){
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
				                //Translates all the condition operators
								$cond_operators = translateConfigArray("pakka.shipment_condition_operator");
			                ?>

							{!! Form::mySelect('operator[]', null, $cond_operators, null, ['class' => 'form-control select2', 'data-search' => '-1']) !!}
				        </td>
				        
				        <td>
					        {!! Form::myInput('number', 'value[]') !!}
				        </td>
				        
			            <td width="25%">
				            <?php
								//Translates all the condition operators
								$cond_types = translateConfigArray("pakka.shipment_condition_type");
			                ?>
			                {!! Form::mySelect('type[]', null, $cond_types, null, ['class' => 'form-control select2', 'data-search' => '-1']) !!}
				        </td>
				        
				        <td width="63px" class="pR-0">
	                        <a class="btn btn-danger table-form-remove" href="#"><i class="ti-trash"></i></a>
	                    </td>						            
			        </tr>
			        
			        @if(isset($shipment['conditions']))
						@foreach($shipment['conditions'] as $condition)
							<tr>
							    <td width="25%" class="pL-0">					
									{!! Form::mySelect('operator[]', null, $cond_operators, $condition['operator'], ['class' => 'form-control select2', 'data-search' => '-1']) !!}
						        </td>
						        
						        <td>
									{!! Form::myInput('text', 'value[]', null, [], $condition['value']) !!}
						        </td>
						        
					            <td width="25%">
									{!! Form::mySelect('type[]', null, $cond_types, $condition['type'], ['class' => 'form-control select2', 'data-search' => '-1']) !!}
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
		</div><!-- ends second container -->
		  
	</div>

	<div class="col-sm-4">
		{{ constructTransSelect() }}
		
		<div class="bgc-white p-20 mB-30 bd">
			<p><b>{{ trans('pakka::app.settings') }}:</b></p>
			<div class="list-group list-group-status">
					
				@if (isset($shipment['status']))
					@switch($shipment['status'])
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
								
				<a href="#" class="list-group-item list-group-item-action list-group-head {{ $onlineClass }}" data-status="1">{{ trans('pakka::app.online') }}</a>
				<a href="#" class="list-group-item list-group-item-action {{ $offlineClass }}" data-status="0">{{ trans('pakka::app.offline') }}</a>
			</div>
			{!! Form::myInput('hidden', 'status', '', ["class" => "status-input"]) !!}
		</div>
		
		<button type="submit" class="btn btn-primary-gradient">{{ trans('pakka::app.save_button') }}</button>
	</div>
</div>