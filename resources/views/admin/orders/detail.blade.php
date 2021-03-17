@extends('pakka::admin.default')

@section('page-header-alt')
	<h4 class="c-grey-900 mT-10">
		Bestelling	 
		<small>
			{{ $order['name'] }}
			{{ getOrderFulfillmentStatus($order['fulfillment_status']) }}
			{{ getOrderFinancialStatus($order['financial_status']) }}
		</small>
	</h4>
@endsection

@section('content')
	
	<div class="row pX-15 pT-5 pB-30">
		
		<a href="/admin/orders/{{$order['id']}}/view/packslip" target="_blank" class="text-body mr-3"><i class="fa fa-print mr-1"></i>Print</a>
		
		@if($order['financial_status'] == 1)
			<div class="dropdown">
				<a href="#" id="mail-dropdown" class="text-body mr-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fa fa-envelope-o mr-1"></i>
					Emails
					<i class="fa fa-caret-down"></i>
				</a>
				
				<div class="dropdown-menu" aria-labelledby="mail-dropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
					<a class="dropdown-item" href="/admin/orders/{{$order['id']}}/mail/order-confirmation">
						<i class="ti-package text-primary mR-10"></i>
						{{ trans('pakka::app.send_order_confirmation') }}
					</a>
					
					<a class="dropdown-item" href="/admin/orders/{{$order['id']}}/mail/shipment-confirmation">
						<i class="ti-truck text-primary mR-10"></i>
						{{ trans('pakka::app.send_shipment_confirmation') }}
					</a>
				</div>
			</div>
		@endif
		
		<div class="dropdown">
			<a href="#" id="more-dropdown" class="text-body mr-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Meer acties <i class="fa fa-caret-down"></i></a>
			
			<div class="dropdown-menu" aria-labelledby="more-dropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
				
				<p class="mb-2"><b class="pX-15">{{ trans('pakka::app.packslip') }}</b></p>
				
				<a class="dropdown-item" href="/admin/orders/{{$order['id']}}/view/packslip" target="_blank"><i class="ti-file text-primary mR-10"></i>{{ trans('pakka::app.view_packslip') }}</a>
				<a class="dropdown-item" href="/admin/orders/{{$order['id']}}/download/packslip" target="_blank"><i class="ti-download text-primary mR-10"></i>{{ trans('pakka::app.download_packslip') }}</a>
				
				<hr>
				
				@if($order['financial_status'] == 1 && !empty($order['documents']))
					<p class="mb-2"><b class="pX-15">{{ trans('pakka::app.bookkeeping') }}</b></p>
					
					<a class="dropdown-item" href="/view/invoice/{{ $order['documents'][0]['document_id'] }}" target="_blank"><i class="ti-file text-primary mR-10"></i>{{ trans('pakka::app.view_invoice') }}</a>
					<a class="dropdown-item" href="/download/invoice/{{ $order['documents'][0]['document_id'] }}" target="_blank"><i class="ti-download text-primary mR-10"></i>{{ trans('pakka::app.download_invoice') }}</a>
					<a class="dropdown-item" href="{{ route(config('pakka.prefix.admin'). '.invoices.copy', ['id' => $order['documents'][0]['document_id'] , 'credit' => true]) }}"><i class="ti-layers text-primary mR-10"></i>{{ trans('pakka::app.generate_creditnote') }}</a>
					
					<hr>
				@endif
				
				{!! Form::open([
                    'class'=>'delete',
                    'url'  => route(config('pakka.prefix.admin'). '.orders.retour', $order['id']), 
                    'method' => 'GET',
                    ]) 
                !!}

                    <button class="dropdown-item text-danger"><i class="ti-back-left mR-10"></i>{{ trans('pakka::app.retour_order') }}</button>   
                                     
                {!! Form::close() !!}
				
				{!! Form::open([
                    'class'=>'delete',
                    'url'  => route(config('pakka.prefix.admin'). '.orders.cancel', $order['id']), 
                    'method' => 'GET',
                    ]) 
                !!}

                    <button class="dropdown-item text-danger"><i class="ti-close mR-10"></i>{{ trans('pakka::app.cancel_order') }}</button>  
                                     
                {!! Form::close() !!}
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-8">
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
		        <p>
			        <b>{{ trans('pakka::app.fulfillment') }}</b> 
			        
			        {{ getOrderFulfillmentStatus($order['fulfillment_status']) }}
		        </p>
		        
		        <table class="table" width="100%">
			        <thead>
				        <th colspan="2">{{ trans('pakka::app.product') }}</th>
				        <th>{{ trans('pakka::app.price') }}</th>
				        <th class="text-center">{{ trans('pakka::app.quantity') }}</th>
				        <th width="110px">{{ trans('pakka::app.total') }}</th>
			        </thead>
			        
			        <tbody>
				        @foreach($order['items'] as $item)
				        	<?php	
								$price = formatNumber($item['price']);
								$totalPrice = formatNumber($item['price']*$item['quantity']);
								switch (true) {
								    case $price < 0:
								        $price = str_replace('-', '-€', $price);
								        $totalPrice = str_replace('-', '-€', $totalPrice);
								        break;
								    case $price == 0:
								        $price = "<span class='text-primary'>Gratis</span>";
								        $totalPrice = "<span class='text-primary'>Gratis</span>";
								        break;
								    case $price > 0:
								        $price = "€".$price;
								        $totalPrice = "€".$totalPrice;
								        break;
								}
								
								//GET SHIPMENT
								if(!empty($order['shipment']) && $order['shipment']['option_name'] == $item['name']){
									$shipmentPrice = $price;
								}
								
								//GET COUPON
								if(!empty($order['coupon']) && $order['coupon']['name'] == $item['name']){
									$couponPrice = $price;
								}
								
							?>
					        <tr>
						        <td>
							        @if(!empty($item['product_id']))
							        	@php( $image = TheRealJanJanssens\Pakka\Models\Images::where('item_id', $item['product_id'])->orderBy('position')->first() )
							        	@if(isset($image->item_id))
							        		<img src="{!! url('/').imgUrl($image->item_id, $image->file, 100) !!}" alt="{!! $item['name'] !!}" title="{!! $item['name'] !!}" width="100" class="bdrs-3"></a>
							        	@endif
							        @endif
							        
						        </td>
					        	<td class="align-middle">
						        	@if(!empty($item['product_id']))
							        	<a href="{{ route(config('pakka.prefix.admin'). '.products.edit', $item['product_id']) }}" class="text-body font-weight-normal"><b>{!! $item['name'] !!}</b></a>
							        @else
							        	<b>{!! $item['name'] !!}</b>
							        @endif
								    <br>
						        	<span class="text-subinfo">{{ $item['sku'] }}</span>
					        	</td>
					        	<td class="align-middle">{!! $price !!}</td>
					        	<td class="align-middle text-center">{{ $item['quantity'] }}</td>
					        	<td class="align-middle"><b>{!! $totalPrice !!}</b></td>
					        </tr>
					        
					        <tr>
						        <td colspan="5" class="py-0"><hr class="m-0"></td>
					        </tr>
				        @endforeach   
					</tbody>
				</table>
		        
		        <div class="mT-15 text-right">
		        	<a href="/admin/orders/{{$order['id']}}/view/packslip" class="btn btn-outline-secondary" target="_blank"><i class="ti-file mr-2"></i>{{ trans('pakka::app.view_packslip') }}</a>
		        	
		        	@if($order['fulfillment_status'] < 2)
						<a href="/admin/orders/{{$order['id']}}/shipment/edit" class="btn btn-primary-gradient"><i class="ti-package mr-2"></i>{{ trans('pakka::app.mark_as_send') }}</a>
					@endif
		        </div>
		    </div>
		    
		    <div class="bgc-white bd bdrs-3 p-20 mB-20">
			    <p>
				    <b>{{ trans('pakka::app.payment') }}</b>
					
					{{ getOrderFinancialStatus($order['financial_status']) }}
				</p>
			    
			    @php( $calculate = TheRealJanJanssens\Pakka\Models\Invoice::calculateInvoice($order,true) )
			    
			    <table class="table table-sm mb-0" width="100%">
			        <tbody>
				        
				        @if(!empty($order['coupon']))
					        <tr>
						        <td class="px-0">{{ trans('pakka::app.discount') }}</td>
						        <td>
							        {{ $order['coupon']['name'] }}
							        <br>
							        <span class="text-subinfo">{{ $order['coupon']['code'] }}</span>
							    </td>
						        <td class="text-right">{{ $couponPrice ?? trans('pakka::app.unknown') }}</td>
					        </tr>
				        @endif
				        
				        @if(!empty($order['shipment']))
					        <tr>
						        <td class="px-0">{{ trans('pakka::app.shipping') }}</td>
						        <td>
							        {{ $order['shipment']['option_name'] }}
							        <br>
							        <span class="text-subinfo">{{ trans('pakka::app.weight') }}: {{ $order['shipment']['weight'] }}gr</span>
							    </td>
						        <td class="text-right">{{ $shipmentPrice ?? trans('pakka::app.unknown') }}</td>
					        </tr>
				        @endif
				        
				        @if(!empty($order['shipment']) || !empty($order['coupon']))
					        <tr>
						        <td colspan="3" class="px-0"><hr></td>
					        </tr>
				        @endif
				        
				        <tr>
					        <td class="px-0">{{ trans('pakka::app.subtotal') }}</td>
					        <td></td>
					        <td class="text-right">€{{ formatNumber($calculate['subtotal']) }}</td>
				        </tr>
				        
				        <tr>
					        <td class="px-0">{{ trans('pakka::app.vat_short') }}</td>
					        <td></td>
					        <td class="text-right">€{{ formatNumber($calculate['vattotal']) }}</td>
				        </tr>
				        
				        <tr>
					        <td class="px-0"><b>{{ trans('pakka::app.total') }}</b></td>
					        <td></td>
					        <td class="text-right"><b>€{{ formatNumber($calculate['total']) }}</b></td>
				        </tr>
				        
				        @if(!empty($order['payment']))
				        	@php( $payment = \Mollie::api()->payments->get($order['payment']['payment_id']) )
					        <tr>
						        <td colspan="3" class="px-0"><hr></td>
					        </tr>
					        
					        <tr>
						        <td colspan="2" class="px-0">
							        {{ trans('pakka::app.paid_via_with', ['provider' => ucfirst($order['payment']['provider']), 'method' => $order['payment']['method']]) }}
									
									@php( $payProvStatus = trans('pakka::app.'.$payment->status) )
									
							        @switch($payment->status)
							        	@case("open")
									    @case("pending")
									        <span class="badge badge-pill badge-warning ml-2">{{ $payProvStatus }}</span>
									        @break
									    @case("paid")
									    @case("authorized")
									        <span class="badge badge-pill badge-success ml-2">{{ $payProvStatus }}</span>
									        @break
									    @case("failed")
									        <span class="badge badge-pill badge-danger ml-2">{{ $payProvStatus }}</span>
									        @break
									    @case("expired")
									    @case("canceled")
									        <span class="badge badge-pill badge-secondary ml-2">{{ $payProvStatus }}</span>
									        @break
									@endswitch 
							    </td>
							    <td class="text-right">
								    <a href="{{ $payment->_links->dashboard->href }}">{{ trans('pakka::app.to_dashboard', ['provider' => ucfirst($order['payment']['provider'])]) }} <i class="fa fa-angle-right ml-2"></i></a>
							    </td>
					        </tr>
				        @endif
			    	</tbody>
				</table>
			    
		    </div>
		    
		</div>
		
		<div class="col-sm-4">
			
			<div class="bgc-white bd bdrs-3 p-20 mB-20">
		        <p><b>{{ trans('pakka::app.notes') }}</b></p>
		        <p class="mb-0">{!! $order['instructions'] ? $order['instructions'] : '<span class="text-muted">'.trans('pakka::app.no_customer_notes').'</span>' !!}</p>
		    </div>
		    
		    <div class="bgc-white bd bdrs-3 p-20 mB-20">
		        <p><b>{{ trans('pakka::app.client') }}</b></p>
		        <p>      
			        {!! $order['details']['company_name'] ? $order['details']['company_name'] : $order['details']['firstname'].' '.$order['details']['lastname'] !!}<br>
			        Klantnummer: {{ $order['details']['user_id'] }}
			    </p>
		        
		        <hr>
		        
		        <p class="d-flex justify-content-between">
			        <b>{{ trans('pakka::app.contact_info') }}</b>
			        <a href="/admin/orders/{{$order['id']}}/details/edit">{{ trans('pakka::app.edit') }}</a>
			    </p>
		        <p>
			        {{ $order['details']['email'] }}<br>
			        {{ $order['details']['phone'] }}<br>
			    </p>
		        
		        @if(!empty($order['shipment']))
		        	<hr>
		        
			        <p class="d-flex justify-content-between">
				        <b>{{ trans('pakka::app.shipping_address') }}</b>
				        <a href="/admin/orders/{{$order['id']}}/shipment/edit">{{ trans('pakka::app.edit') }}</a>
				    </p>
			        <p class="mb-0">
				        {{ $order['shipment']['firstname'] }} {{ $order['shipment']['lastname'] }}<br>
				        {{ $order['shipment']['address'] }}<br>
				        {{ $order['shipment']['zip'] }} {{ $order['shipment']['city'] }}<br>
				        {{ $order['shipment']['country'] }}<br><br>
				        
				        {{ trans('pakka::app.delivery_method') }}: {{ $order['shipment']['option_name'] }}<br>
				        {{ trans('pakka::app.tracking') }}: {!! $order['shipment']['track_code'] ? $order['shipment']['track_code'] : trans('pakka::app.no_tracking') !!}
				    </p>
			    @endif
		    </div>
			
		</div>
	</div>

@endsection