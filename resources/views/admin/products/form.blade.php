<div class="row">
	<div class="col-sm-8">
		<div class="bgc-white mB-30 p-20 bd">
			<?php
				$h = 0;
				$s = Session::get('current_item_id'); //hIMR
				$sl = strlen($s);
				
				function intval32bits($value){
				    $value = ($value & 0xFFFFFFFF);
				    if ($value & 0x80000000){
					    $value = -((~$value & 0xFFFFFFFF) + 1);
				    }
				    return $value;
				}
				
				for($i = 0; $i <= strlen($s)-1; $i++){
					$imul = intval32bits(bcmul(31,$h));
					$charCodeAt = intval32bits(ord(substr($s, $i, 1)));
					$h = $imul + $charCodeAt;
				}
			?>
			
			<input type="hidden" name="product_id" value="{!! Session::get('current_item_id') !!}">
			
			<p><b>Product informatie</b></p>
			
			@foreach ($lang as $langItem)
				{!! Form::myInput('text', 'name', 'Naam', ["data-slugify" => "true", "data-output" => "slug"], null, $langItem["language_code"]) !!}
			@endforeach
			
			@php(constructInputs($inputs,2))
			
			@foreach ($lang as $langItem)
				{!! Form::myTextArea('description', 'Omschrijving', [], null, $langItem["language_code"]) !!}
			@endforeach
			
			<div class="form-group dropzone-input">
	    		<label for="images[]">Afbeeldingen</label>
				
		    	@if(isset($product))
		    		@php($productId = $product['id'])
					@php(listImages($productId, $product,'images'))
				@endif
	    	
	       		<div id="dropzone__container" class="dropzone dropzone-previews">

					<div class="fallback">
						<input type="file" name="images[]" required="true" multiple/>
					</div>
					
					<div class="dz-default dz-message">
						<span>
							<i class="ti-image"></i>Sleep je afbeeldingen hierheen
						</span>
					</div>
					
					<div id="preview-template" style="display:none">
						<div class="dz-preview dz-file-preview">
							<div class="dz-overlay">
								<img src="/images/vendor/app/loading_white.gif" alt="loading" title="loading">
							</div>
							<div class="dz-image">
								<img data-dz-thumbnail />
							</div>

							<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
							<div class="dz-success-mark"><span>✔</span></div>
							<div class="dz-error-mark"><span>✘</span></div>
							<div class="dz-error-message"><span data-dz-errormessage></span></div>
							<div class="dz-edit">
								<a class="dz-rotate" href="javascript:undefined;">
									<i class="ti-back-right"></i>
								</a>
							</div>
						</div>
					</div>
					
				</div>
		    </div>
			
			
			@php( $productId = Session::get('current_item_id') )
			
			
		</div>
		
		<div class="bgc-white mB-30 p-20 bd">
			<p><b>Prijzing</b></p>
			
			<div class="row">
				<div class="col-sm-6">
					{!! Form::myPrice('base_price', 'Prijs', ["class" => "price_input"], ($product['base_price'] ?? 0) ) !!}
				</div>
				
				<div class="col-sm-6">
					{!! Form::myPrice('compare_price', 'Vergelijk prijs met', [], ($product['compare_price'] ?? 0) ) !!}
				</div>
			</div>
		</div>
		
		<div class="bgc-white mB-30 p-20 bd">
			
			<p><b>Product varianten</b></p>
			
			@if(strpos(Route::getCurrentRoute()->uri, 'edit') !== false)
				<div class="alert alert-warning alert-dismissible fade show">
				    <h4 class="alert-heading"><i class="fa fa-warning"></i> Opgelet!</h4>
				    <p>Wanneer je een variant aan het product toevoegt, moet je voorraden en prijzen opnieuw in voeren.</p>
				    <hr>
				    <p class="mb-0">Noteer je graag even deze gegevens voor je een variant toevoegt? <a href="#" class="alert-link">Ga naar Product voorraad</a></p>
				    <button type="button" class="close text-right" data-dismiss="alert">&times;</button>
				</div>
			@endif
			
			<table class="table table-bordered table-rounded table-form table-tagsinput" cellspacing="0" data-head="true">
			    <thead>
			        <tr>
			            <th width="30%">Option</th>
			            <th colspan="2">Option values</th>
			        </tr>
			    </thead>
			    <tbody>
				    
				    <tr class="table-form-template">

			            <td>
			                <div class="input-group">
								<input type="text" data-name="variants[variant_values][]" class="form-control">
							</div>
							<input type="hidden" data-name="variants[variant_ids][]" class="form-control" value="0">
				        </td>
				        
			            <td>
				            <div class="input-group">
								<input type="text" data-name="variants[option_values][]" class="form-control" data-role= "tagsinput">
							</div>
				        </td>
				        
			            <td class="text-center" width="70px">
				            <input type="hidden" data-name="variants[option_ids][]" class="form-control" value="0">
	                        <a class="btn btn-danger table-form-remove" href="#"><i class="ti-trash"></i></a>
	                    </td>
			        </tr>

			        @if(isset($product['variants']) && !empty($product['variants']))
			        
			        	@foreach($product['variants'] as $variant)
				        	<tr>
	
					            <td>
					                <div class="input-group">
										<input type="text" name="variants[variant_values][]" class="form-control" value="{{ $variant['name'] }}">
									</div>
									<input type="hidden" name="variants[variant_ids][]" class="form-control" value="{{ $variant['id'] }}">
						        </td>
						        
					            <td>
						            <div class="input-group">
										<input type="text" name="variants[option_values][]" class="form-control" data-role= "tagsinput" value="{{ $variant['option_values'] }}">
									</div>
						        </td>
						        
					            <td class="text-center" width="70px">
						            <input type="hidden" name="variants[option_ids][]" class="form-control" value="{{ $variant['option_ids'] }}">
			                        <a class="btn btn-danger table-form-remove" href="#"><i class="ti-trash"></i></a>
			                    </td>
					        </tr>
			        	@endforeach
			        @else
			        	<tr>

				            <td>
				                <div class="input-group">
									<input type="text" name="variants[variant_values][]" class="form-control">
								</div>
								<input type="hidden" name="variants[variant_ids][]" class="form-control" value="0">
					        </td>
					        
				            <td>
					            <div class="input-group">
									<input type="text" name="variants[option_values][]" class="form-control" data-role= "tagsinput">
								</div>
					        </td>
					        
				            <td class="text-center" width="70px">
					            <input type="hidden" name="variants[option_ids][]" class="form-control" value="0">
		                        <a class="btn btn-danger table-form-remove" href="#"><i class="ti-trash"></i></a>
		                    </td>
				        </tr>
			        @endif
			        
			    </tbody>
			    
			    <tfoot>
				    <tr>
					    <td colspan="3">
						    <span class="text-primary table-form-add"><i class="ti-plus"></i> Voeg variant type toe</span>
						</td>
				    </tr>
			    </tfoot>
			</table>
		</div>
		
		<div class="bgc-white mB-30 p-20 bd"> <!-- variant-tab d-none -->
			<p><b>Product voorraden</b></p>
							
			<table class="table table-bordered table-rounded table-form table-variants" cellspacing="0">
			    <thead>
			        <tr>
			            <th>Variant</th>
			            <th>SKU</th>
			            <th>Price</th>
			            <th>Stock</th>
			            <th>Gewicht (gram)</th>
			        </tr>
			    </thead>
			    
			    <tbody>
				    @if(isset($product['stocks']))
			        	@foreach($product['stocks'] as $stock)
			        		
			        		@php($option_values = explode(',',$stock['option_values']))
			        		
				        	<tr data-sku="@foreach($option_values as $option){{ $option }}@endforeach">
					        	<td>
						        	@if(!empty($stock['option_values']))
						        		@php($i = 0)
							        	@foreach($option_values as $option)
							        		@if($i !== 0) + @endif
							        		<span>{{ $option }}</span>
							        		@php($i++)
							        	@endforeach
						        	@else
						        		-
						        	@endif
						        </td> 
						        
					        	<td>
						        	<input type="hidden" name="stocks[sku][]" class="form-control" value="{{ $stock['sku'] }}">
						        	<input type="hidden" name="stocks[option_ids][]" class="form-control" value="{{ $stock['option_ids'] }}">
						        	<input type="hidden" name="stocks[option_values][]" class="form-control" value="{{ $stock['option_values'] }}">
						        	<p>{{ $stock['sku'] }}</p>
						        </td> 
						        
						        <td>
							        <input type="number" name="stocks[price][]" class="form-control variant-price" value="{{ $stock['price'] }}" step="0.01">
							    </td> 
							    
							    <td>
								    <input type="number" name="stocks[quantity][]" class="form-control" value="{{ $stock['quantity'] }}">
								</td>
								
								<td>
								    <input type="number" name="stocks[weight][]" class="form-control" value="{{ $stock['weight'] }}">
								</td>
							</tr>
			        	@endforeach
			        @endif
			    </tbody>
			</table>	
			
			<input type="hidden" name="remove_variants" value="0">
			
			<!-- 
				Solution with typeahead:			
			<input type="text" data-role="tagsinput" data-suggestions='[{"value": 1,"text": "Amsterdam"},{"value": 1,"text": "Antwerpen"},{"value": 4,"text": "Washington"},{"value": 7,"text": "Sydney"},{"value": 10,"text": "Beijing"},{"value": 13,"text": "Cairo"}]'> 
			-->
		</div>
		
		<button type="submit" class="btn btn-primary">{{ trans('pakka::app.save_button') }}</button> 
	</div>
	
	<div class="col-sm-4">
		
		{{ constructTransSelect() }}
		
		<div class="bgc-white p-20 mB-30 bd">
			<p><b>{{ trans('pakka::app.settings') }}:</b></p>
			@foreach ($lang as $langItem)
				{!! Form::myInput('text', 'slug', null, ["class" => "form-control slug-input", "placeholder" => "slug"], null, $langItem["language_code"]) !!}
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
		
		<div class="bgc-white p-20 mB-30 bd">
			<p><b>Organisatie</b></p>
			
			{!! Form::myItemsSelect('collections[]', 'Collecties', $collections, null, ['class' => 'form-control select2 select-custom-input', 'multiple' => 'multiple']); !!}
			<p>Voeg dit product toe aan een collectie zodat het makkelijk terug te vinden is in jouw webshop.</p>
			
			<a href="/admin/collections" class="btn btn-light d-block">Beheer Collecties</a>
		</div>
		
<!--
		<div class="bgc-white p-20 mB-30 bd">
			<p><b>{{ trans('pakka::app.report.title') }}</b></p>
			<p>{{ trans('pakka::app.report.text') }}</p>
			
		</div>
-->
		
		<button type="submit" class="btn btn-primary">{{ trans('pakka::app.save_button') }}</button>
		
	</div>
</div>