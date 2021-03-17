<div class="mB-40">
	
	<!-- Modal -->
	<div class="modal fade p-20" id="preset-modal" tabindex="-1" role="dialog" aria-labelledby="preset-modal-title" aria-hidden="true">	
	  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="preset-modal-title">Kies een artikel</h5>
	        
	        <span aria-hidden="true" class="close" data-dismiss="modal" aria-label="Close">&times;</span>
	        
	        
	      </div>
	      <div class="modal-body">
		    <div class="row justify-center">
			    @php( $presets = App\InvoicePreset::all()->toArray() )
				@foreach($presets as $preset)
				
					<div class="col-sm-3">
						<div class="bd p-10 preset-item text-center" data-name="{{ $preset['name'] }}" data-price="{{ str_replace('.', ',', $preset['price']) }}" data-quantity="{{ $preset['quantity'] }}" data-vat="{{ $preset['vat'] }}">
							<b>{{ $preset['name'] }}</b>
							<p class="m-0">{{ $preset['quantity'] }} X {{ $settings['invoice_valuta'] }}{{ str_replace('.', ',', $preset['price']) }}</p>
						</div>
					</div>
				
				@endforeach
			</div>
	      </div>
	      <div class="modal-footer">
	        <a href="" class="btn btn-primary-gradient">Beheer artikelen</a>
	      </div>
	    </div>
	  </div> 
	</div>
	
	<!-- Form -->
	<div class="bgc-white p-20 bd container-fluid">
		<div class="row">
			<div id="invoice-client" class="col-sm-6">
				
				<div class="row">
					<div class="col-sm-12">
						<div class="row justify-center">
							<div class="col-sm-6">

								@php($clients = App\User::constructSelect(1))
								
								<div class="form-group row">
									<label for="client-select" class="col-sm-3 col-form-label">{{ trans("pakka::app.client") }}</label>
									
									<select id="client-select" class="col-sm-9 form-control select2 client-select select2-hidden-accessible" data-placeholder="Selecteer een klant" name="client-select" aria-hidden="true">
										<option></option>
										
										@if($clients)
											@foreach($clients as $key => $item)
												<?php
													if(isset($document) && (isset($document['client_id']) && $key == $document['client_id'])){
														$selected = "selected";
													}else{
														$selected = "";
													}
												?>
												<option value="{{ $key }}" {{ $selected }}>{{ $item }}</option>
											@endforeach
										@endif
									</select>
	        					</div>
								
								<!-- Form::mySelect('role', trans("pakka::app.client"), $clients, null, ['id' => 'add-client-btn', 'class' => 'col-sm-9 form-control select2', "data-placeholder" => trans("pakka::app.select_client")], "xs") -->
							</div>
							
							<div class="col-sm-6">
								{!! Form::mySwitch('other_shipping_info', trans('pakka::app.other_shipping_info'), '', false); !!}
							</div>
						</div>
					</div>
					
					<div id="company_info" class="col-sm-6">
						<p><b>Company info</b></p>
						{!! Form::myInput('text', 'client_name', '', ["placeholder" => trans("pakka::app.name")]) !!}
						{!! Form::myInput('text', 'client_email', '', ["placeholder" => trans("pakka::app.email")]) !!}
						{!! Form::myInput('text', 'client_address', '', ["placeholder" => trans("pakka::app.address")]) !!}
						<div class="row">
							<div class="col-sm-6">
								{!! Form::myInput('text', 'client_zip', '', ["placeholder" => trans("pakka::app.zip")]) !!}
							</div>
							<div class="col-sm-6">
								{!! Form::myInput('text', 'client_city','' , ["placeholder" => trans("pakka::app.city")]) !!}
							</div>
						</div>
						
						{!! Form::myInput('text', 'client_country', '', ["placeholder" => trans("pakka::app.country")]) !!}
						{!! Form::myInput('text', 'client_vat', '', ["placeholder" => trans("pakka::app.vat")]) !!}
					</div>
					
					@if(isset($document['other_shipping_info']))
						@php($hidden = "")
					@else
						@php($hidden = "hidden")
					@endif
					
					<div id="shipping_info" class="col-sm-6 {{ $hidden }}">
						<p><b>Shipping info</b></p>
						{!! Form::myInput('text', 'ship_name', '', ["placeholder" => trans("pakka::app.name")]) !!}
						{!! Form::myInput('text', 'ship_address', '', ["placeholder" => trans("pakka::app.address")]) !!}
						<div class="row">
							<div class="col-sm-6">
								{!! Form::myInput('text', 'ship_zip', '', ["placeholder" => trans("pakka::app.zip")]) !!}
							</div>
							<div class="col-sm-6">
								{!! Form::myInput('text', 'ship_city','' , ["placeholder" => trans("pakka::app.city")]) !!}
							</div>
						</div>
						
						{!! Form::myInput('text', 'ship_country', '', ["placeholder" => trans("pakka::app.country")]) !!}
					</div>
				</div>

				{!! Form::myInput('hidden', 'client_id', '') !!}
				{!! Form::myInput('hidden', 'order_id','') !!}
			</div>
			
			<div class="col-sm-2">
			</div>
			
			<div class="col-sm-4">
				<div class="container-fluid">
					
					<?php
						//Translates all the status types
						$status = translateConfigArray("pakka.invoice_status");
						
						//Translates all the invoice types
						$types = translateConfigArray("pakka.document_type");

						//invoiceNo input
						if(isset($document['document_numbers'])){
							$documentNo = $document['document_numbers'];
							
							foreach($document['document_numbers'] as $key => $value){
								$noData['data-doctype-'.$key] = $value;
							}
							
							if(isset($document['invoice_no'])){
								$no = $document['invoice_no'];
							}else{
								$no = $document['document_numbers']['1'];
							}
							
							echo Form::myInput('text', 'invoice_no', trans("pakka::app.document_no"), $noData, $no, null, "s");
						}
						
						if(!isset($document['description'])){
							$document['description'] = "";
						}
					?>

					{!! Form::myInput('date', 'date', trans("pakka::app.date"), array(), $document['date'], null, "s") !!}
					{!! Form::myInput('date', 'due_date', trans("pakka::app.due_date"), array(), $document['due_date'], null, "s") !!}
					{!! Form::mySelect('status', trans("pakka::app.status"), $status, null, ['class' => 'col-sm-7 p-0 form-control select2', 'data-search' => '-1'], "s") !!}
					{!! Form::mySelect('type', trans("pakka::app.type"), $types, null, ['class' => 'col-sm-7 p-0 form-control select2 invoice-type-select', 'data-search' => '-1'], "s") !!}
					
					{!! Form::myTextArea('description', trans("pakka::app.description"), array(), $document['description'], null, "s") !!}
				</div>
			</div>
		</div>
		
		<table class="table table-bordered table-rounded table-invoice table-form table-sort mT-20" data-head="true" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="50%">{{ trans('pakka::app.service_product') }}</th>
                    <th>{{ trans('pakka::app.quantity') }}</th>
                    <th>{{ trans('pakka::app.price') }}</th>
                    <th>{{ trans('pakka::app.vatper') }}</th>
                    <th>{{ trans('pakka::app.total') }}</th>
                    <th class="text-center"><i class="fa fa-cog"></i></th>
                </tr>
            </thead>
            
            
            
            <tbody>
	            <tr class="table-form-template invoice-item">
                    <td>
                        <i class="handle ti-line-double"></i>
                        <input type="text" data-name="name[]" placeholder="{{ trans('pakka::app.service_product') }}">
                        <input type="hidden" data-name="position[]">
                        <i class="ti-tag insert-preset"></i>
                    </td>
                    <td><input type="number" data-name="quantity[]" value="1" placeholder="{{ trans('pakka::app.quantity') }}" step="0.01"></td>
                    <td><input type="number" data-name="price[]" placeholder="{{ trans('pakka::app.price') }}" step="0.01"></td>
                    <td><input type="number" data-name="vat[]"  min='0' value="{{ $settings['invoice_default_vat'] }}" placeholder="{{ trans('pakka::app.vatper') }}"></td>
                    <td><span class="invoice-item-total"></span></td>
                    <td class="text-center">
                        <i class="ti-more-alt" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item table-form-duplicate invoice-item-duplicate" href="#"><i class="ti-layers mR-10"></i>Dupliceren</a>
                        <a class="dropdown-item table-form-remove invoice-item-remove text-danger" href="#"><i class="ti-trash mR-10"></i>Verwijderen</a>
                    </div>
                    </td>
                </tr>
	            
	            @if(isset($document['items']))
	            	@php($i = 1)
	            	@foreach($document['items'] as $item)
	               		<tr class="invoice-item">
	                        <td>
		                        <i class="handle ti-line-double"></i>
		                        <input type="text" name="name[]" value="{{ $item['name'] }}" placeholder="{{ trans('pakka::app.service_product') }}">
		                        
		                        <input type="hidden" name="position[]" value="{{ $i }}">
		                        <i class="ti-tag insert-preset"></i>
		                    </td>
	                        <td>
		                        <input type="number" name="quantity[]" value="{{ $item['quantity'] }}" placeholder="{{ trans('pakka::app.quantity') }}" step="0.01">
		                    </td>
		                    
	                        <td>
		                        <input type="number" name="price[]" value="{{ $item['price'] }}" placeholder="{{ trans('pakka::app.price') }}" step="0.01">
		                    </td>
		                    
	                        <td>
		                        <input type="number" name="vat[]" value="{{ $item['vat'] }}" min='0' placeholder="{{ trans('pakka::app.vatper') }}">
		                    </td>
		                    
	                        <td>
		                        <span class="invoice-item-total">0</span>
		                    </td>
		                    
	                        <td class="text-center">
		                        <i class="ti-more-alt" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
		                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
		                        <a class="dropdown-item table-form-duplicate invoice-item-duplicate" href="#"><i class="ti-layers mR-10"></i>Dupliceren</a>
		                        <a class="dropdown-item table-form-remove invoice-item-remove text-danger" href="#"><i class="ti-trash mR-10"></i>Verwijderen</a>
		                    </div>
		                    </td>
	                    </tr>
	                    @php($i++)
                    @endforeach
                @else
                	<tr class="invoice-item">
                        <td>
	                        <i class="handle ti-line-double"></i>
	                        <input type="text" name="name[]" value="" placeholder="{{ trans('pakka::app.service_product') }}">
	                        <input type="hidden" name="position[]" value="1">
	                        <i class="ti-tag insert-preset"></i>
	                    </td>
	                    
                        <td>
	                        <input type="number" name="quantity[]" value="1" min='1' placeholder="{{ trans('pakka::app.quantity') }}" step="0.01">
	                    </td>
	                    
                        <td>
	                        <input type="number" name="price[]" placeholder="{{ trans('pakka::app.price') }}" step="0.01">
	                    </td>
	                    
                        <td>
	                        <input type="number" name="vat[]" value="{{ $settings['invoice_default_vat'] }}" min='0' placeholder="{{ trans('pakka::app.vatper') }}">
	                    </td>
	                    
                        <td>
	                        <span class="invoice-item-total">0</span>
	                    </td>
	                    
                        <td class="text-center">
	                        <i class="ti-more-alt" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
	                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
		                        <a class="dropdown-item table-form-duplicate invoice-item-duplicate" href="#"><i class="ti-layers mR-10"></i>Dupliceren</a>
		                        <a class="dropdown-item table-form-remove invoice-item-remove text-danger" href="#"><i class="ti-trash mR-10"></i>Verwijderen</a>
		                    </div>
	                    </td>
                    </tr>
                @endif
            </tbody>
        </table>
        
        <a href="#" class="link table-form-add invoice-item-add"><i class="ti-plus mR-10"></i>{{ trans('pakka::app.add_service_product') }}</a>
        
        <div class="container-fluid">
			<div class="row">
				<div class="col-sm-8 mt-3 pl-0">
				</div>
				<div class="col-sm-4 invoice-total-list">

					<div class="invoice-total-list-item row">
						<div class="col-6 text-right">
							<b>{{ trans('pakka::app.subtotal') }} ({{ $settings['invoice_valuta'] }})</b>
						</div>
						<div class="col-6">
							<b id="invoice-subtotal">0</b>
						</div>
					</div>
					
					<div class="invoice-total-list-item row">
						<div class="col-6 text-right">
							<b>{{ trans('pakka::app.vat_short') }} (<span id="invoice-default-vat">{{ $settings['invoice_default_vat'] }}</span>%)</b>
						</div>
						<div class="col-6">
							<b id="invoice-vattotal">0</b>
						</div>
					</div>
					
					<div class="invoice-total-list-item row">
						<div class="col-6 text-right">
							<b>{{ trans('pakka::app.total') }} ({{ $settings['invoice_valuta'] }})</b>
						</div>
						<div class="col-6">
							<b id="invoice-total">0</b>
						</div>
					</div>
					
				</div>
			</div>
        </div>
	</div>  
	
	<button type="submit" class="btn btn-primary-gradient mT-20">{{ trans('pakka::app.save_button') }}</button>

</div>