<section class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="cart row">
            <div class="col-md-9 col-md-offset-0 col-sm-10 col-sm-offset-1">
	            <?php
                    $items = Cart::getContent();
                ?>
                @if($items->count() !== 0)
	                <table class="table table-borderless" cellspacing="0">
	                    <thead>
	                        <tr class="type--fade">
	                            <th>{{ trans('pakka::webshop.product') }}</th>
	                            <th></th>
	                            <th>{{ trans('pakka::webshop.price') }}</th>
	                            <th>{{ trans('pakka::webshop.quantity') }}</th>
	                            <th>{{ trans('pakka::webshop.total') }}</th>
	                            <th>&nbsp;</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	
		                    @foreach($items as $item)
		                    	<tr class="cart-item" data-ca='update' data-sku='{{ $item->id }}' data-price='{{ $item->price }}' data-quantity='{{ $item->quantity }}'>
		                            <td>
		                                <a href="#">
			                                @if(isset($item->attributes['images'][0]))
			                                	<div class="img {{ parseSecAttr('.img', $section['classes']) }}">
		                                    		<img alt="{{ $item->attributes['name'] }}" class="b-lazy i {{ parseSecAttr('.i', $section['classes']) }}" {{ parseImage($item->attributes, $item->attributes['images'][0], 100, true) }}>
			                                	</div>
		                                    @endif
		                                </a>
		                            </td>
		                            <td>
		                                <span>
			                                <b>{!! $item->name !!}</b>
			                                {{ !empty($item->attributes['option_values']) ? '('.$item->attributes['option_values'].')': '' }}<br>
			                                <small>{{ $item->id }}</small>
		                                </span>
		                                
		                                <div class="@if($item->attributes['quantity'] !== $item->quantity) d-none @endif text-center alert alert-warning mt-3 mb-0 e {{ parseSecAttr('.e', $section['classes']) }}" role="alert">
			                                <i class="fa fa-warning mr-2"></i><b>{{ trans('pakka::cart.last_items', [ 'quantity' => $item->attributes['quantity']]) }}</b>
			                            </div>
		                            </td>
		                            <td>
			                            <b>€ {!! formatNumber( $item->price ) !!}</b>
		                            </td>
		                            <td>
		                            	<div class="form-inline"> 
											<div class="input-group input-quantity d-flex align-items-center boxed m-0 p-0 e {{ parseSecAttr('.e', $section['classes']) }}">
												<span class="input-group-btn">
													<button type="button" class="btn btn-default btn-number px-3 border-0" data-type="minus">
													<span class="fa fa-minus"></span>
													</button>
												</span>
												
												<input type="text" name="quantity" class="form-control input-number border-0" value="{{ $item->quantity }}" min="1" max="{{ $item->attributes['quantity'] }}">
												
												<span class="input-group-btn">
													<button type="button" class="btn btn-default btn-number px-3 border-0" data-type="plus">
														<span class="fa fa-plus"></span>
													</button>
												</span>
											</div>
		                            	</div>
		                            </td>
		                            <td>
		                                <b class="color--primary">€ {!! formatNumber( Cart::get($item->id)->getPriceSum() ) !!}</b>
		                            </td>
		                            <td scope="row">
		                                <a href="#" class="btn rounded-circle px-3" data-ca='destroy' data-sku='{{ $item->id }}'>
			                                <i class="fa fa-times"></i>
		                                </a>
		                            </td>
		                        </tr>
		                    @endforeach
	                    </tbody>
	                </table>
	            @else
		            <div class="text-center">
		            	<p class="lead">{{ trans('pakka::webshop.cart_empty') }}</p>
		            	<a href="{!! url('/'.$settings['role_product_list']) !!}" class="btn btn--primary d-block my-5 e {{ parseSecAttr('.e', $section['classes']) }}">
		                	<span class="btn__text">
	                    		{{ trans('pakka::webshop.go_shop') }}
		                	</span>
	                	</a>
		            </div>
				@endif
				
				<?php $services = \TheRealJanJanssens\Pakka\Models\CartService::getAvailableCartServices(); ?>
				
				@if(isset($services))
					<div class="select-group">
						@foreach($services as $service)
							<div class="select-item p-3 boxed @if(Cart::getCondition('SERVICE '.$service['id'])) active @endif e {{ parseSecAttr('.e', $section['classes']) }}" data-ca="@if(Cart::getCondition('SERVICE '.$service['id'])) remove-service @else set-service @endif" data-value="{{ $service['id'] }}">
								@if(isset($service['icon']))
									<div class="select-item-label">
										<i class="{{ $service['icon'] }} color--primary h5"></i>
									</div>
								@endif
								
			                	<div class="select-item-text">
			                		<b>{{ $service['name'] }}</b><br>
									<span>{{ $service['description'] }}</span><br>
									@if($service['price'] == 0)
										<b class="color--primary">{{ trans('pakka::webshop.free') }}</b>
									@else
										<b class="color--primary">€{{ $service['price'] }}</b>
									@endif
		                		</div>
		                	</div>
						@endforeach
					</div>
				@endif
				
				<div class="boxed e pb-0 {{ parseSecAttr('.e', $section['classes']) }}">
	                <?php
		                $regions = TheRealJanJanssens\Pakka\Models\ShipmentOption::getAvailableRegions();
		                $shipment_options = TheRealJanJanssens\Pakka\Models\ShipmentOption::getAvailableOptions();
		                
		                $shipment_id = null;
		                if(Cart::getCondition('SHIPPING')){
			                $shipment_id = Cart::getCondition('SHIPPING')->getAttributes()['id'];
		                }
	                ?>
	                
                    <h5 class="uppercase">{{ trans('pakka::webshop.calculate_shipment') }}</h5>
                    <div class="select-option">
                        <i class="fa fa-angle-down"></i>
                        <select class="cart-region e {{ parseSecAttr('.e', $section['classes']) }}" data-ca='set-region' data-input=".cart-region">
                            @foreach($regions as $key => $value)
                            	<option value="{{ $key }}" @if($key == Session::get('checkout.details.country')) selected @endif>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!--end select-->
					
                    <div class="select-group" data-group="delivery">
	                    <div class="row">
		                    @foreach($shipment_options as $delivery)
		                    	<div class="col-md-6">
			                    	<b>{{ $delivery['title'] }}</b>
			                    	@foreach($delivery['options'] as $option)
					                	<div class="select-item p-3 boxed @if($option['id'] == $shipment_id) active @endif e {{ parseSecAttr('.e', $section['classes']) }}" data-ca='set-delivery' data-input=".cart-delivery">
						                	<div class="input-radio"> 
						                		<div class="select-item-label"> 
						                			<input type="radio" class="cart-delivery" value="{{ $option['id'] }}"> 
													<label></label> 
						                		</div>
						                		
						                		<div class="select-item-text">
							                		<b>{{ $option['name'] }}</b><br>
													<span>{{ $option['description'] }}</span><br>
													@if($option['price'] == 0)
														<b class="color--primary">Gratis</b>
													@else
														<b class="color--primary">€{{ $option['price'] }}</b>
													@endif
						                		</div>
						                	</div>
					                	</div>	
									@endforeach
			                    	
			                    	@foreach($delivery['options'] as $option)
		<!--
					                	<div class="select-item p-3">
						                	<div class="input-radio input-radio--innerlabel"> 
						                		<input type="radio"> 
												<label>
													<b>{{ $option['name'] }}</b><br>
													<span>{{ $option['description'] }}</span><br>
													@if($option['price'] == 0)
														<b class="color--primary">Gratis</b>
													@else
														<b class="color--primary">€{{ $option['price'] }}</b>
													@endif
												</label> 
						                	</div>
					                	</div>	
		-->
									@endforeach
		                    	</div>
		                    @endforeach
	                    </div>
                    </div>
                </div>
				
				@if( $items->count() !== 0 && shopStatus())
                	<a href="{!! url('/'.$settings['role_checkout']) !!}" class="btn btn--primary d-block mt-3 e {{ parseSecAttr('.e', $section['classes']) }}">
	                	<span class="btn__text">
                    		{{ trans('pakka::webshop.finish_order') }}
	                	</span>
                	</a>
                @endif
				
            </div>
            <!--end of items-->
            <div class="cart-total col-md-3 col-md-offset-0 col-sm-10 col-sm-offset-1">
	            <?php
					$subTotal = Cart::getSubTotalWithoutConditions();
					$cartTotal = Cart::getTotal();
					$vat = $cartTotal - getExclAmount($cartTotal); 
                ?>
                
                <div class="mb-4 boxed e {{ parseSecAttr('.e', $section['classes']) }}">
                    <h5 class="uppercase">{{ trans('pakka::webshop.your_total') }}</h5>
                    
<!--
                    <div class="d-flex align-items-center justify-content-between my-1">
	                    <b class="f-size-5">Subtotaal</b>
                        <b class="f-size-5">€ {{ formatNumber( $subTotal ) }}</b>
                    </div>
                    
                    <hr class="my-3">
-->
                    
                    @if(Cart::getConditionsByType('service'))
                    	<?php 
                        	$serviceTotal = 0;
                        	foreach(Cart::getConditionsByType('service') as $service){
	                        	$serviceTotal += $service->parsedRawValue;
                        	}
                    	?>
                    	<div class="d-flex align-items-center justify-content-between my-1">
		                    <b class="type--fade">{{ trans('pakka::webshop.extra_services') }}</b>
	                        <b class="type--fade">€ {{ formatNumber( $serviceTotal ) }}</b>
	                    </div>              	
                    @endif
                    
                    @if(Cart::getCondition('COUPON'))
                    	<div class="d-flex align-items-center justify-content-between my-1">
	                    	<b class="type--fade">
                                <?php
	                                if(strpos(Cart::getCondition('COUPON')->getValue(),'%') !== false){
		                                $coupon_value = str_replace('-', '-€', Cart::getCondition('COUPON')->getValue());
	                                }else{
		                                $coupon_value = Cart::getCondition('COUPON')->getValue();
	                                }
                                ?>
                                {{ trans('pakka::webshop.discount') }} @if(strpos(Cart::getCondition('COUPON')->getValue(),'%') !== false) ({!!Cart::getCondition('COUPON')->getValue()!!}) @endif
                            </b>
                            <b class="type--fade">-€ {{ formatNumber( Cart::getCondition('COUPON')->parsedRawValue ) }}</b>
                        </div>
                    @endif
                    
                    @if(Cart::getCondition('SHIPPING'))
                    	<div class="d-flex align-items-center justify-content-between my-1">
		                    <b class="type--fade">{{ trans('pakka::webshop.shipment_cost') }}</b>
	                        <b class="type--fade">€ {{ formatNumber( Cart::getCondition('SHIPPING')->parsedRawValue ) }}</b>
	                    </div>
                    @endif
                    
                    <div class="d-flex align-items-center justify-content-between my-1">
	                    <b class="type--fade">{{ trans('pakka::webshop.vat') }} (21%)</b>
                        <b class="type--fade">€ {{ formatNumber( $vat ) }}</b>
                    </div>
                    
                    <hr class="my-3">
                    
                    <div class="d-flex align-items-center justify-content-between my-1">
	                    <b class="f-size-5 color--primary">{{ trans('pakka::webshop.total') }}</b>
                        <b class="f-size-5 color--primary">€ {{ formatNumber( $cartTotal ) }}</b>
                    </div>

                    @if( $items->count() !== 0 && shopStatus())
	                	<a href="{!! url('/'.$settings['role_checkout']) !!}" class="btn btn--primary d-block mt-3 e {{ parseSecAttr('.e', $section['classes']) }}">
		                	<span class="btn__text">
	                    		{{ trans('pakka::webshop.finish_order') }}
		                	</span>
	                	</a>
	                @endif
					
                </div>
                
                <h5 class="uppercase">{{ trans('pakka::webshop.add_coupon') }}</h5>
                <div>
	                @if(Cart::getCondition('COUPON'))
                    	<input type="text" placeholder="{{ trans('pakka::webshop.coupon') }}" class="cart-coupon mb-3 e {{ parseSecAttr('.e', $section['classes']) }}" value="{{ Cart::getCondition('COUPON')->getAttributes()['code'] }}">
	                @else
	                	<input type="text" placeholder="{{ trans('pakka::webshop.coupon') }}" class="cart-coupon mb-3 e {{ parseSecAttr('.e', $section['classes']) }}">
	                @endif
	                
	                @if(Cart::getCondition('COUPON'))
                    	<a href="#" class="btn btn--primary d-block mb-3 e {{ parseSecAttr('.e', $section['classes']) }}" data-ca='revoke-coupon'>
		                    <span class="btn__text">
		                    	{{ trans('pakka::webshop.remove') }}
		                    </span>
		                </a>
	                @else
	                	<a href="#" class="btn btn--primary d-block mb-3 e {{ parseSecAttr('.e', $section['classes']) }}" data-ca='redeem-coupon' data-input=".cart-coupon">
		                    <span class="btn__text">
		                    	{{ trans('pakka::webshop.apply') }}
		                    </span>
		                </a>
	                @endif
	                
	                @if(Cart::getCondition('COUPON'))
						<div class="alert coupon-alert alert-success text-center e {{ parseSecAttr('.e', $section['classes']) }}" role="alert">
                            <i class="fa fa-check mr-2"></i><b>{{ trans('pakka::webshop.valid_coupon') }}</b>
                        </div>
		            @endif
		            
		            <div class="alert coupon-alert alert-danger text-center d-none e {{ parseSecAttr('.e', $section['classes']) }}" role="alert">
                        <i class="fa fa-warning mr-2"></i><b>{{ trans('pakka::webshop.invalid_coupon') }}</b>
                    </div>
                </div>
                
            </div>
            <!--end of totals-->
        </div>
        <!--end of row-->
    </div>
{!! constructDividers($section) !!}
</section>