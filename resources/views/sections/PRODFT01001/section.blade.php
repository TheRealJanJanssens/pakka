<section class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
	    <div class="row">
		    <div class="col-12">
			    <?php //dd($section); ?>
			    @if(checkContent($section['PRODFT01001_H'], 'title'))
			    	<h2>{{ parseContent($section['PRODFT01001_H'],'title') }}</h2>
			    @endif
			    
			    @if(checkContent($section['PRODFT01001_H'], 'subtitle'))
			    	<h3>{{ parseContent($section['PRODFT01001_H'],'subtitle') }}</h3>
			    @endif
		    </div>
	    </div>
	    
	    <div class="row">
            <div class="col">
                <div class="slider" {{ parseSecAttr('.slider', $section['attributes']) }}>                
	                <?php
		                $products = App\Product::getProducts(1, $sort = "desc", 10);
	                ?>
	                
	                @foreach($products as $product)
	                	<?php
		                	$jsonStock = App\Product::getStockJson($product['stocks']);
	                	?>
	                	<div class="p-3">
		                	<a href="{!! url('/'.$settings['role_product_detail'].'/'.$product['id'].'/'.$product['slug']) !!}" class="product boxed p-0 e {{ parseSecAttr('.e', $section['classes']) }}">
								
								<div class="p-4">
			                        <div class="img  {{ parseSecAttr('.img', $section['classes']) }}">
				                        @if($product['compare_price'] !== 0.0)
				                        	<div class="label e {{ parseSecAttr('.e', $section['classes']) }}">{{ trans('pakka::webshop.promo') }}</div>
				                        @endif
				                    	<img alt="{{ $product['name'] }}" class="b-lazy mb-0" {{ parseImage($product, $product['images'][0], 500, true) }}>
				                    	@if(shopStatus())
						                	<div 
							                	class="btn btn--primary btn--cart type--uppercase" 
								                href="javascript:void(0);" 
									            data-sku='' 
										        data-success='{{ trans("pakka::cart.add_success") }}' 
											    data-oos='{{ trans("pakka::cart.out_of_stock") }}' 
												data-atc='{{ trans("pakka::cart.add_to_cart") }}' 
												data-stock='{{ $jsonStock }}'>
							                	<span class="btn__icon">
								            		<i class="fa fa-plus mr-2"></i>
								            	</span>
								                <span class="btn__text">
													Toevoegen aan winkelmandje
												</span> 
											</div>
						                @endif
				                    	
				                    </div>
								</div>
		                        
		                        <div class="pb-4 px-4 text-center">
	                                <h6 class="mb-2 type--body-font type--uppercase type--fine-print">{!! $product['name'] !!}</h6>
	                                <!-- <span>subtitle</span>  -->
	                                <b class="h4">
		                                @if($product['compare_price'] !== 0.0)
						                	<span class="ml-3 color--error">
						                		€ {!! formatNumber($product['base_price'],false) !!}
											</span>
											
											<span class="type--strikethrough type--fine-print">
			                                	€ {!! formatNumber($product['compare_price']) !!}
			                                </span>
						                @else
						                	<span class="color--primary">
			                                	€ {!! formatNumber($product['base_price']) !!}
			                                </span>
						                @endif
	                                </b>
	                            </div>
		                    </a>
	                	</div>
	                @endforeach
                </div>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>