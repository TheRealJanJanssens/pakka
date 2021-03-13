<section class="switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
                <div class="container">
                    <div class="row">
                        <div class="col-md-9">
	                        
	                        <?php 
	                            
	                            if(isset(Request()->o)){
		                            $o = Request()->o;
	                            }else{
		                            $o = "desc";
	                            }
	                            
	                            $products = TheRealJanJanssens\Pakka\Models\Product::getProductsByCollection(Request()->param1,1,$o);
                            ?>
				            
                            <div class="row">
                                <div class="col-md-4 col-sm-4 masonry-item col-xs-12">
                                    <div class="select-option select-request">
                                        <i class="ti-angle-down"></i>
                                        <select>
                                            <option value="desc" {!! Request()->o == 'desc' ? "selected" : null !!}>{{ trans('pakka::webshop.new_first') }}</option>
                                            <option value="asc" {!! Request()->o == 'asc' ? "selected" : null !!}>{{ trans('pakka::webshop.old_first') }}</option>
                                        </select>
                                    </div>
                                    <!--end select-->
                                </div>
                                <div class="col-md-8 text-right">
                                    <span class="input-lh">{!! count($products) !!} {{ trans('pakka::webshop.results') }}</span>
                                </div>
                            </div>
                            <!--end of row-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <hr>
                                </div>
                            </div>
                            <!--end of row-->
                            <div class="row masonry fadeIn">
	                            
				                @foreach($products as $product)
				                	<?php
					                	$jsonStock = TheRealJanJanssens\Pakka\Models\Product::getStockJson($product['stocks']);
				                	?>
				                	<div class="masonry-item p-3 item {{ parseSecAttr('.item', $section['classes']) }}">
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
                            <!--end of row-->
                            <div class="text-center mt40">
<!--
                                <ul class="pagination">
                                    <li>
                                        <a href="#" aria-label="Previous">
                                            <span aria-hidden="true">«</span>
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="#">1</a>
                                    </li>
                                    <li>
                                        <a href="#">2</a>
                                    </li>
                                    <li>
                                        <a href="#">3</a>
                                    </li>
                                    <li>
                                        <a href="#">4</a>
                                    </li>
                                    <li>
                                        <a href="#">5</a>
                                    </li>
                                    <li>
                                        <a href="#" aria-label="Next">
                                            <span aria-hidden="true">»</span>
                                        </a>
                                    </li>
                                </ul>
-->
                            </div>
                        </div>
                        <!--end of nine col-->
                        <div class="col-md-3 hidden-sm">
                            <div class="widget">
                                <h5>{{ trans('pakka::webshop.categories') }}</h5>
                                <hr>
                                
                                <?php
	                                $collections = TheRealJanJanssens\Pakka\Models\Collection::getCollections(1);
                                ?>
                                
                                <ul class="link-list">
	                                @foreach($collections as $collection)
	                                    <li>
	                                        <a href="{!! url('/'.$settings['role_product_list'].'/'.$collection['id'].'/'.$collection['slug']) !!}" alt="{{ stripslashes($collection['name']) }}" class="f-size-5 "><b>{{ stripslashes($collection['name']) }}</b></a>
	                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!--end of widget-->
                            
<!--
                            <div class="widget">
                                <h6 class="title">Search Shop</h6>
                                <hr>
                                <form>
                                    <input class="mb0" type="text" placeholder="Type Here">
                                </form>
                            </div>
-->
                            <!--end of widget-->
                            
<!--
                            <div class="widget">
                                <h6 class="title">Popular Items</h6>
                                <hr>
                                <ul class="cart-overview">
                                    <li>
                                        <a href="#">
                                            <img alt="Product" src="img/shop-product-7.jpg">
                                            <div class="description">
                                                <span class="product-title">Vladimir Flask</span>
                                                <span class="price number">$49.95</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <img alt="Product" src="img/shop-product-13.jpg">
                                            <div class="description">
                                                <span class="product-title">Bradley Journal</span>
                                                <span class="price number">$29.95</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
-->
                            <!--end of widget-->
                            
<!--
                            <div class="widget">
                                <h6 class="title">Returns Policy</h6>
                                <hr>
                                <p>
                                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem antium doloremque laudantium, totam rem aperiam, eaque ipsa quae.
                                </p>
                            </div>
-->
                            <!--end of widget-->

                        </div>
                        <!--end of sidebar-->
                    </div>
                    <!--end of container row-->
                </div>
                <!--end of container-->
            {!! constructDividers($section) !!}
</section>