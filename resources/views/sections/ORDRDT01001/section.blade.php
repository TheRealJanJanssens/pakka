<section class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-md-center">
            @if(isset(Request()->param2))
	            @php( $order = App\Order::getOrder(Request()->param1,Request()->param2) )
	            
	            @if( isset($order) && $order['financial_status'] == 1 )
	            	@php( $order = App\Invoice::calculateInvoice($order,true) )
		            <div class="col-md-10 e p-5 mb-0 boxed {{ parseSecAttr('.e', $section['classes']) }}">
			            <div class="text-center">
				            <i class="h1 mb-4 color--success far fa-check-circle"></i>
				            
				            <h4 class="mb-4">We hebben jouw bestelling ontvangen!</h4>
				            <h5 class="mb-2">Bestelling: {{ $order['name'] }}</h5>
				            <p class="lead">We hebben jou een bevestigingsmail gestuurd naar <span class="type--underline">{{ $order['details']['email'] }}</span><br>
					        	 Klopt er iets niet? Laat het ons weten, dan passen we het gelijk aan!</p>
			            </div>
			            
			            <div class="row">
				            <div class="col-12">
					            <h5 class="mt-5 mb-0">Bestellingsinformatie</h5>
					            <hr class="my-4">
				            </div>
			            </div>
			            
			            <div class="row">
				            <div class="col-md-6">
					            <b>Jouw gegevens</b>
					            <p>
						            {{ $order['details']['firstname'] }} {{ $order['details']['lastname'] }}<br>
						            {{ $order['details']['address'] }}<br>
						            {{ $order['details']['zip'] }} {{ $order['details']['city'] }}<br>
						            {{ $order['details']['country'] }}<br>
						            <br>
						            @if(isset($order['details']['vat']))
						            	{{ $order['details']['vat'] }}<br>
						            @endif
						            {{ $order['details']['email'] }}<br>
						            {{ $order['details']['phone'] }}
					            </p>
				            </div>
				            
				            <div class="col-md-6">
					            <b>Levermethode</b>
					            <p>
						            {{ $order['shipment']['option_name'] }}
					            </p>
					            
					            <b>Leveradres</b>
					            <p>
						            {{ $order['shipment']['firstname'] }} {{ $order['shipment']['lastname'] }}<br>
						            {{ $order['shipment']['address'] }}<br>
						            {{ $order['shipment']['zip'] }} {{ $order['shipment']['city'] }}<br>
						            {{ $order['shipment']['country'] }}
					            </p>
				            </div>
			            </div>
				            
			            <div class="row">
				            <div class="col-12">
					            <h5 class="mt-5 mb-0">Artikelen</h5>
					            <hr class="my-4">
				            </div>
			            </div>
				            
			            @foreach($order['items'] as $item)
			            	<div class="row">
				            	<?php
			                        //$price = $item['price']*$item['quantity'];
									$price = $item['price'];
									switch (true) {
									    case $price < 0:
									        $price = str_replace('-', '-€', formatNumber($price));
									        break;
									    case $price == 0:
									        $price = "<b class='color--primary'>Gratis</b>";
									        break;
									    case $price > 0:
									        $price = "€".formatNumber($price);
									        break;
									}
			                    ?>
			                    
			                    @if(!empty($item['product_id']))
			                    	@php($image = App\Images::where('item_id', $item['product_id'])->orderBy('position')->first())
			                    	<a href="{!! url('/'.$settings['role_product_detail'].'/'.$item['product_id']) !!}" target="_blank" class="col-12 block">
						            	<img src="{!! url('/').imgUrl($image->item_id, $image->file, 100) !!}" alt="{{ $item['name'] }}" title="{{ $item['name'] }}" class="d-inline-block mb-0 mr-4 pos-vertical-center">
										
										<div class="d-inline-block">
				                           	{!! $item['name'] !!}
				                            @if(!empty($item['sku']))
				                            	<br><span class="f-size-3 type--fade">{{ $item['sku'] }}</span>
				                            @endif
				                            <br><b class="f-size-5 mb-3 d-inline-block">{{ $price }}</b>
				                            <br><span class="d-inline-block">Aantal: {{ $item['quantity'] }}</span>
										</div>
			                        </a>
		                        @else
		                        	
		                        	<div class="col-6 text-left p">
							            <span>{{ $item['name'] }}</span>
						            </div>
	                        		
	                        		<div class="col-6 text-right">
							            <p>{!! $price !!}</p>
						            </div>
		                        	
		                        @endif
		                        <div class="col-12"> 
		                        	<hr class="my-4">
		                        </div>
	                        </div>
		                    
			            @endforeach
			            
			            <div class="row mb-5">
		                	<div class="col-6 text-left">
					            <p class="h5">Totaal</p>
				            </div>
		            		
		            		<div class="col-6 text-right">
					            <p class="h5">€ {{ formatNumber($order['total']) }}</p>
				            </div>
		            	</div>
			            
			            <div class="row">
				            <div class="col-12">
					            <a href="{!! url('/') !!}" class="btn e {{ parseSecAttr('.e', $section['classes']) }}">
						            <div class="btn__text">
							            <i class="fas fa-arrow-left f-size-5 mr-2"></i>
							            Terug naar de webshop
						            </div>
					            </a>
					            <a href="{!! url('/view/invoice').'/'.$order['documents'][0]['document_id'] !!}" class="btn btn--primary e {{ parseSecAttr('.e', $section['classes']) }}">
						            <div class="btn__text">
							            <i class="fas fa-file-invoice f-size-5 mr-2"></i>
							            Bekijk factuur
						            </div>
					            </a>
				            </div>
			            </div>
			            
		            </div>
	            @else
		            <div class="col-md-10 e p-5 mb-0 boxed {{ parseSecAttr('.e', $section['classes']) }}">
			            <div class="text-center mb-4">
				            <i class="h1 mb-4 color--error far fa-times-circle"></i>
				            
				            <h4 class="mb-4">We hebben jouw niet bestelling ontvangen!</h4>
				            <p class="lead">
					            Wellicht is er iets misgelopen bij de verwerking van je bestelling. Contacteer ons zodat we je kunnen helpen bij het plaatsen van je bestelling.<br><br>
					            <span class="type--underline">{{ $settings['company_email'] }}</span>
					            @if(isset($settings['company_phone']))
					            	of <span class="type--underline">{{ $settings['company_phone'] }}</span>
					            @endif
				            </p>
			            </div>
			            
			            <div class="row text-center">
				            <div class="col-12">
					            <a href="{!! url('/') !!}" class="btn e {{ parseSecAttr('.e', $section['classes']) }}">
						            <div class="btn__text">
							            <i class="fas fa-arrow-left f-size-5 mr-2"></i>
							            Terug naar de webshop
						            </div>
					            </a>
				            </div>
			            </div>
		            </div>
	            @endif
            @else
        		<div class="col-md-10 e p-5 mb-0 boxed {{ parseSecAttr('.e', $section['classes']) }}">
		            <div class="text-center mb-4">
			            <i class="h1 mb-4 color--primary far fa-question-circle"></i>
			            
			            <h4 class="mb-4">Geen bestelling in verwerking</h4>
			            <p class="lead">
				            Was je toch met een bestelling bezig en je ziet dit bericht? Contacteer ons zodat we je kunnen helpen bij het plaatsen van je bestelling.<br><br>
					            <span class="type--underline">{{ $settings['company_email'] }}</span>
					            @if(isset($settings['company_phone']))
					            	of <span class="type--underline">{{ $settings['company_phone'] }}</span>
					            @endif
				        </p>
		            </div>
		            
		            <div class="row text-center">
			            <div class="col-12">
				            <a href="{!! url('/') !!}" class="btn e {{ parseSecAttr('.e', $section['classes']) }}">
					            <div class="btn__text">
						            <i class="fas fa-arrow-left f-size-5 mr-2"></i>
						            Terug naar de webshop
					            </div>
				            </a>
			            </div>
		            </div>
	            </div>
            
            @endif
        </div>
        <!--end of container row-->
    </div>
    <!--end of container-->
{!! constructDividers($section) !!}
</section>