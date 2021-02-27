<section class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
	    <form class="form-checkout form--active" action="/cart/submit" method="post" data-success="{{ trans('pakka::form.form_success') }}" data-error="{{ trans('pakka::form.form_error') }}">
		    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	        @honeypot
		    
	        <div class="row justify-content-center">
	            <div class="col-md-12 col-lg-8 cart-customer-details">
	                <h4>{{ trans('pakka::webshop.billing_details') }}</h4>
<!--
	                <p>Already a customer?
	                    <a href="#">Log in here</a>
	                </p>
-->
					<?php
		                $regions = App\ShipmentOption::getAvailableRegions();
		                $shipment_options = App\ShipmentOption::getAvailableOptions();
		                
		                $shipment_id = null;
		                if(Cart::getCondition('SHIPPING')){
			                $shipment_id = Cart::getCondition('SHIPPING')->getAttributes()['id'];
		                }
	                ?>
					
	                <div class="row">
	                    <div class="col-md-6">
	                        <label>{{ trans('pakka::form.name') }}:</label>
	                        <input type="text" name="firstname" class="validate-required e {{ parseSecAttr('.e', $section['classes']) }}" >
	                    </div>
	                    <div class="col-md-6">
	                        <label>{{ trans('pakka::form.lastname') }}:</label>
	                        <input type="text" name="lastname" class="validate-required e {{ parseSecAttr('.e', $section['classes']) }}">
	                    </div>
	                    <div class="col-md-6">
	                        <label>{{ trans('pakka::form.company') }}:</label>
	                        <input type="text" name="company_name" class="e {{ parseSecAttr('.e', $section['classes']) }}">
	                    </div>
	                    <div class="col-md-6">
	                        <label>{{ trans('pakka::form.company_number') }}:</label>
	                        <input type="text" name="vat" class="e {{ parseSecAttr('.e', $section['classes']) }}">
	                    </div>
	                    <div class="col-md-6">
	                        <label>{{ trans('pakka::form.email') }}:</label>
	                        <input type="email" name="email" class="validate-required e {{ parseSecAttr('.e', $section['classes']) }}">
	                    </div>
	                    
	                    <div class="col-md-6">
	                        <label>{{ trans('pakka::form.phone') }}:</label>
	                        <input type="text" name="phone" class="e {{ parseSecAttr('.e', $section['classes']) }}">
	                    </div>
	                    
	                    <div class="col-md-12 mt-3">
	                        <label>{{ trans('pakka::form.address') }}:</label>
	                        <input type="text" name="apt" placeholder="{{ trans('pakka::form.apt') }}" class="e {{ parseSecAttr('.e', $section['classes']) }}">
	                        <input type="text" name="street" placeholder="{{ trans('pakka::form.street') }}" class="e {{ parseSecAttr('.e', $section['classes']) }}">
	                        <input type="text" name="city" placeholder="{{ trans('pakka::form.city') }}" class="e {{ parseSecAttr('.e', $section['classes']) }}">
	                        <input type="text" name="zip" placeholder="{{ trans('pakka::form.zip') }}" class="e {{ parseSecAttr('.e', $section['classes']) }}">
	                        <div class="select-option my-3 e {{ parseSecAttr('.e', $section['classes']) }}">
		                        <i class="fa fa-angle-down"></i>
		                        <select class="cart-region" name="country" data-ca='set-region' data-input=".cart-region">
		                            @foreach($regions as $key => $value)
		                            	<option value="{{ $key }}" @if($key == Session::get('checkout.details.country')) selected @endif>{{ $value }}</option>
		                            @endforeach
		                        </select>
		                    </div>
	                    </div>
	                </div>
	                
	                <h4 class="mt-5">{{ trans('pakka::webshop.shipment_options') }}</h4>
	            	<div class="row">    
	                    <div class="select-group col-md-12" data-group="delivery">
		                    <div class="row">
			                    @foreach($shipment_options as $delivery)
			                    	<div class="col-md-6">
				                    	<b>{{ $delivery['title'] }}</b>
				                    	@foreach($delivery['options'] as $option)
						                	<div class="select-item p-3 mt-3 boxed boxed--border @if($option['id'] == $shipment_id) active @endif e {{ parseSecAttr('.e', $section['classes']) }}" data-ca='set-delivery' data-input=".cart-delivery">
							                	<div class="input-radio"> 
							                		<div class="select-item-label"> 
							                			<input type="radio" class="cart-delivery" value="{{ $option['id'] }}"> 
														<label></label> 
							                		</div>
							                		
							                		<div class="select-item-text">
								                		<b class="d-block">{{ $option['name'] }}</b>
														<span class="d-block">{{ $option['description'] }}</span>
														@if($option['price'] == 0)
															<b class="color--primary">Gratis</b>
														@else
															<b class="color--primary">€{{ $option['price'] }}</b>
														@endif
							                		</div>
							                	</div>
						                	</div>	
										@endforeach
			                    	</div>
			                    @endforeach
		                    </div>	
	                    </div>
	            	</div>
	            	
	            	<?php
		            	$methods = \Mollie::api()->methods->all();
	            	?>
	            	
	            	<h4 class="mt-5">{{ trans('pakka::webshop.payment_options') }}</h4>
                    <div class="select-group" data-group="payment-method">
	                    <div class="row">
		                    @foreach($methods as $method)
		                    	<div class="col-md-4">
			                    	<div class="select-item p-3 mt-3 boxed boxed--border text-center e {{ parseSecAttr('.e', $section['classes']) }}" data-input=".payment-method">
					                	<div class="input-radio"> 
					                		<div class="select-item-label hidden"> 
					                			<input type="radio" class="payment-method" name="payment_method" value="{!! htmlspecialchars($method->id) !!}"> 
												<label></label> 
					                		</div>
					                		
					                		<div class="select-item-text">
						                		<img src="{!! htmlspecialchars($method->image->svg) !!}" srcset="{!! htmlspecialchars($method->image->size2x) !!} 2x" alt="{!! htmlspecialchars($method->description) !!}">
						                		<b class="color--primary">{!! htmlspecialchars($method->description) !!}</b>
						                		
					                		</div>
					                	</div>
				                	</div>
		                    	</div>
		                    @endforeach
	                    </div>	
                    </div>
	            	
	            	<h4></h4>
	            	<div class="row">    
	                    <div class="col-md-12">
	                        <label>{{ trans('pakka::form.additional_instructions') }} ({{ trans('pakka::form.optional') }}):</label>
	                        <textarea rows="4" name="instructions" class="e {{ parseSecAttr('.e', $section['classes']) }}"></textarea>
	                    </div>
	                    
	                    <div class="col-md-12">
		                    <div class="d-flex align-items-center">
		                        <div class="input-checkbox my-3"> <!-- validate-required -->
		                            <input type="checkbox" name="marketing_consent" id="consent-input-1" value="1">
		                            <label for="consent-input-1" class="e {{ parseSecAttr('.e', $section['classes']) }}"></label>
		                        </div>
		                        <span>
			                        {{ trans('pakka::form.receive_promo') }}
		                        </span>
		                    </div>
	                        
	                        <div class="d-flex align-items-center">
		                        <div class="input-checkbox my-3"> <!--  -->
		                            <input type="checkbox" name="terms_consent" id="consent-input-2" class="validate-required" value="1">
		                            <label for="consent-input-2" class="e {{ parseSecAttr('.e', $section['classes']) }}"></label>
		                        </div>
		                        <span>
			                        {{ trans('pakka::form.i_accept') }} 
		                            <a href="{!! url('/'.$settings['role_general_terms']) !!}">{{ trans('pakka::form.general_terms') }}</a>
		                        </span>
	                        </div>
	                    </div>
	                    
	                </div>
	                <!--end of row-->
	            </div>
	        </div>

	        <div class="cart row mt--2">
		        <?php
					$subTotal = Cart::getSubTotalWithoutConditions();
					$cartTotal = Cart::getTotal();
					$vat = $cartTotal - getExclAmount($cartTotal); 
	            ?>
		        
	            <div class="col-md-12">
	                <div class="boxed boxed--border cart-total e {{ parseSecAttr('.e', $section['classes']) }}">
<!--
	                    <div class="row">
	                        <div class="col-6">
	                            <span class="h6">{{ trans('pakka::webshop.subtotal') }}:</span>
	                        </div>
	                        <div class="col-6 text-right">
	                            <span>€ {{ formatNumber( $subTotal ) }}</span>
	                        </div>
	                    </div>
-->
	                    
	                    @if(Cart::getCondition('COUPON'))
                            <?php
                                if(strpos(Cart::getCondition('COUPON')->getValue(),'%') !== false){
	                                $coupon_value = str_replace('-', '-€', Cart::getCondition('COUPON')->getValue());
                                }else{
	                                $coupon_value = Cart::getCondition('COUPON')->getValue();
                                }
                            ?>
                            
                            <div class="row">
		                        <div class="col-6">
		                            <span class="h6">{{ trans('pakka::webshop.discount') }} @if(strpos(Cart::getCondition('COUPON')->getValue(),'%') !== false) ({!!Cart::getCondition('COUPON')->getValue()!!}) @endif:</span>
		                        </div>
		                        <div class="col-6 text-right">
		                            <span>-€ {{ formatNumber( Cart::getCondition('COUPON')->parsedRawValue ) }}</span>
		                        </div>
		                    </div>
                        @endif
                        
                        @if(Cart::getCondition('SHIPPING'))
                            <div class="row">
		                        <div class="col-6">
		                            <span class="h6">{{ trans('pakka::webshop.shipment_cost') }}:</span>
		                        </div>
		                        <div class="col-6 text-right">
		                            <span>€ {{ formatNumber( Cart::getCondition('SHIPPING')->parsedRawValue ) }}</span>
		                        </div>
		                    </div>
                        @endif
	                    
	                    <div class="row">
	                        <div class="col-6">
	                            <span class="h6">{{ trans('pakka::webshop.vat') }} (21%):</span>
	                        </div>
	                        <div class="col-6 text-right">
	                            <span>€ {{ formatNumber( $vat ) }}</span>
	                        </div>
	                    </div>
	                    
	                    <hr>
	                    <div class="row">
	                        <div class="col-6">
	                            <span class="h5">{{ trans('pakka::webshop.total') }}:</span>
	                        </div>
	                        <div class="col-6 text-right">
	                            <span class="h5">€ {{ formatNumber( $cartTotal ) }}</span>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        
	        @php($items = Cart::getContent())
	        @if( $items->count() !== 0 && shopStatus())
            	<div class="row justify-content-end mt-4">
		            <div class="col-lg-2 col-md-3 text-right text-center-xs">
		                <button type="submit" class="btn btn--primary type--uppercase e {{ parseSecAttr('.e', $section['classes']) }}">{{ trans('pakka::webshop.to_payment') }}</button>
		            </div>
		        </div>
            @endif
	        
	    </form>
    </div>
{!! constructDividers($section) !!}
</section>