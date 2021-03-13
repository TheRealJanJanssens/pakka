<section class="switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-around">
	        
	        @php( $product = TheRealJanJanssens\Pakka\Models\Product::getProduct( Request()->param1 ) )

			@if(!empty($product))
				
	            <?php   
		            //dd($product);
	                
	                $jsonStock = TheRealJanJanssens\Pakka\Models\Product::getStockJson($product['stocks']);
	            ?>
		        
	            <div class="col-md-7 col-lg-6">
	                <div class="slider e {{ parseSecAttr('.e', $section['classes']) }}" {{ parseSecAttr('.slider', $section['attributes']) }}>
		                @if($product['images'])
	   	                    @foreach($product['images'] as $image)
		   	                    <div class="img {{ parseSecAttr('.img', $section['classes']) }}">
			                    	<img alt="{{ $product['name'] }}" class="b-lazy" {{ parseImage($product, $image, 500, true) }}>
		   	                    </div>
		                    @endforeach
		                @endif
	                </div>
	            </div>
	            
	            <div class="col-md-5 col-lg-4">
	                <h3 class="mb-0">{!! $product['name'] !!}</h3>
	                
	                <div class="text-block">
		                <span class="h3 inline-block color--primary"><b>€ <span class="product-price">{!! formatNumber($product['stocks'][0]['price'],false) !!}</span></b></span>
		                @if(count($product['stocks']) > 1)
		                
		                @else
		                	
		                @endif
		                
		                @if($product['compare_price'] !== 0.0)
		                	<span class="h5 type--strikethrough inline-block ml-2">€ {!! formatNumber($product['compare_price'],false) !!}</span>
		                @endif
		                
<!--
		                <span class="block text-success"><i class="fa fa-check mr-2"></i><b>Op voorraad</b></span>
		                
		                <span class="block text-danger"><i class="fa fa-times mr-2"></i><b>Niet op voorraad</b></span>
-->
		                
	<!--
		                <span class="badge badge-success p-2 f-size-4"><i class="fa fa-check mr-2"></i><b>Op voorraad</b></span>
		                
		                <span class="badge badge-danger p-2 f-size-4"><i class="fa fa-times mr-2"></i><b>Niet op voorraad</b></span>
	-->
		                
		            </div>
		            
		            {!! constructVariantSelect($product['variants'], isset($section['classes']['.e']) ? $section['classes']['.e'] : "") !!}
		            
		            @if(shopStatus())
<!--
		            	<a href="javascript:void(0);" class="btn btn--primary type--uppercase btn--cart d-block mb-4 e {{ parseSecAttr('.e', $section['classes']) }}" data-sku='' data-success='{{ trans("pakka::cart.add_success") }}' data-oos='{{ trans("pakka::cart.out_of_stock") }}' data-atc='{{ trans("pakka::cart.add_to_cart") }}' data-stock='{{ $jsonStock }}'>
			            	<span class="btn__icon">
			            		<i class="fa fa-plus mr-2"></i>
			            	</span>
	                    	<span class="btn__text">
								Toevoegen aan winkelmandje
							</span>
						</a>
-->
		            @endif
		            
	                <ul class="accordion accordion-2 accordion--oneopen">
	                    <li class="active">
	                        <div class="accordion__title"> <span class="h5">{{ trans('pakka::webshop.description') }}</span> </div>
	                        <div class="accordion__content">
	                            <p>{!! nl2br($product['description']) !!}</p>
	                        </div>
	                    </li>
	                    <li>
	                        <div class="accordion__title"> <span class="h5">{{ trans('pakka::webshop.shipment_info') }}</span> </div>
	                        <div class="accordion__content">
	                            @if(checkContent($section['PRODDT01001_SHIP'], 'text'))
							    	<p>{{ parseContent($section['PRODDT01001_SHIP'],'text') }}</p>
							    @endif
	                        </div>
	                    </li>
	                </ul>
	                
	                @if(shopStatus())
	                	<a href="javascript:void(0);" class="btn btn--primary type--uppercase btn--cart d-block mb-4 e {{ parseSecAttr('.e', $section['classes']) }}" data-sku='' data-success='{{ trans("pakka::cart.add_success") }}' data-oos='{{ trans("pakka::cart.out_of_stock") }}' data-atc='{{ trans("pakka::cart.add_to_cart") }}' data-stock='{{ $jsonStock }}'>
			            	<span class="btn__icon">
			            		<i class="fa fa-plus mr-2"></i>
			            	</span>
	                    	<span class="btn__text">
								Toevoegen aan winkelmandje
							</span>
						</a>
	                @endif
	                
	                <form>
	<!--
	                    <div class="col-md-12">
		                    <div class="input-select"> 
			                    <select name="finish">
									<option selected="selected" value="Default">Select A Finish</option>
									<option value="Small">Wood Grain</option>
									<option value="Medium">Brushed Aluminium</option>
									<option value="Larger">Gunmetal Grey</option>
								</select>
							</div>
	                    </div>
	-->
	                    
	                </form>
	            </div>
            
            @endif
            
        </div>
    </div>
{!! constructDividers($section) !!}
</section>