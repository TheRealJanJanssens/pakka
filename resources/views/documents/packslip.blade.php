<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">   	
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800|Open+Sans&display=swap" rel="stylesheet">
    
    <style>
		
		body{
			font-family: 'Open Sans', sans-serif;
			font-size: 14px;
			line-height: 14px;
		}
		
		h1,h2,h3,b,strong{
			font-family: 'Montserrat', sans-serif;
			margin: 0;
		}
		
		p{
			margin: 0;
		}
		
		hr{
			margin: 10px 0px;
			border:none;
			border-bottom: 2px solid rgba(235, 235, 235, 1);
		}
		
		.f-11{
			font-size: 11px;
			line-height: 11px;
		}
		
		.f-12{
			font-size: 12px;
			line-height: 12px;
		}
		
		.f-14{
			font-size: 14px;
			line-height: 14px;
		}
		
		.f-18{
			font-size: 18px;
		}
		
		.f-20{
			font-size: 20px;
		}
		
		.f-light{
			color: rgb(110,110,110);
		}
		
		.t-c{
			text-align: center;
		}
		
		.t-l{
			text-align: left;
		}
		
		.t-r{
			text-align: right;
		}
		
		.d-b{
			display: block;
		}
		
		table{
			border-collapse: collapse;
			width: 100%;
		}
	    
	    thead{
		    background-color: rgba(235, 235, 235, 1);
	    }
	    
	    .invoice-table td{
		    padding: 5px 10px;
	    }
	    
	    .invoice-title h2, .invoice-title h3 {
		    display: inline-block;
		}
		
		.table > tbody > tr > .no-line {
		    border-top: none;
		}
		
		.table > thead > tr > .no-line {
		    border-bottom: none;
		}
		
		.table > tbody > tr > .thick-line {
			border-top: 2px solid rgba(235, 235, 235, 1);
		}
		
		footer {
            position: fixed; 
            bottom: -10px; 
            left: 0px; 
            right: 0px;
            height: 50px; 
        }
        
        footer p{
	        color: rgba(110,110,110, 1);
	        font-size: 11px;
        }
	</style>
    
  <body>
  		<table>
			<tbody>
				<tr>
					<td valign="top" style="width:50%">
						@if(isset($settings['app_logo']))
			            	<img src="{{ base_path() }}{{ config('image.app.public') }}{{ $settings['app_logo'] }}" style="max-width: 150px;">
			            @else
			            	<img src="{{ base_path() }}{{ config('placeholders.logo') }}" style="max-width: 150px;">
			            @endif
						
						</td>
					<td valign="top" style="width:50%; text-align: right; line-height: 16px;">
						<h1 class="d-b" style="font-size:35px;margin-top: 15px;">{{ trans('pakka::app.packslip') }}</h1>
						<p class="f-18 f-light">{{ $order['name'] }}</p>
					</td>
				</tr>
			</tbody>
		</table>
		
		<table class="f-12" style="margin-top: 60px;">
			<tbody>
				<tr>
					<td valign="top" style="width:50%;">
						<b>{{ $settings['company_name'] }}</b>
						<p>{{ $settings['company_address'] }}</p>
						<p>{{ $settings['company_zip'] }} {{ $settings['company_city'] }}</p>
						<p>{{ $settings['company_country'] }}</p>
						<p>{{ $settings['company_email'] }}</p>
						<p>{{ $settings['company_phone'] }}</p>
						<p>{{ $settings['company_vat'] }}</p>
					</td>
					
					<td class="t-r" valign="top" style="width:50%;">
						@if(!empty($order['shipment']['company_name']))
							<b class="f-12">{{ $order['shipment']['company_name'] }}</b>
						@else
							<b class="f-12">{{ $order['shipment']['firstname'] }} {{ $order['shipment']['lastname'] }}</b>
						@endif
						
						<p>{{ $order['shipment']['address'] }}</p>
						<p>{{ $order['shipment']['zip'] }} {{ $order['shipment']['city'] }}</p>
						<p>{{ $order['shipment']['country'] }}</p>
						<p>{{ $order['shipment']['email'] }}</p>
						<p>{{ $order['shipment']['phone'] }}</p>
					</td>
				</tr>
			</tbody>
		</table>
		
		<hr>
		
		<table class="f-11" style="margin-bottom: 15px;">
			<tbody>
				<tr>
					<td valign="top" width="25%">
						<p><b>{{ trans('pakka::app.order_no') }}:</b> {{ $order['name'] }}</p>
					</td>
					
					<td valign="top" width="25%">
						<p><b>{{ trans('pakka::app.date') }}:</b> {{ formatDate($order['created_at']) }}</p>
					</td>
				</tr>
			</tbody>
		</table>

	   <table class="table invoice-table table-condensed">
			<thead>
                <tr>
	                <td></td>
	                <td class="text-center"><strong>{{ trans('pakka::app.description') }}</strong></td>
					<td><strong>{{ trans('pakka::app.quantity') }}</strong></td>
					<td class="text-center"><strong>{{ trans('pakka::app.price') }}</strong></td>
					<td class="text-right"><strong>{{ trans('pakka::app.vatper') }}</strong></td>
					<td class="text-right"><strong>{{ trans('pakka::app.total') }}</strong></td>
                </tr>
			</thead>
			<tbody class="f-12">
				@foreach($order['items'] as $item)
					<tr>
						<td>
							<div style="border:2px solid rgba(235, 235, 235, 1); height: 20px; width: 20px;"></div>
						</td>
						<td>
							{!! html_entity_decode($item['name']) !!}<br>
							<span class="f-light">{!! $item['sku'] ? html_entity_decode($item['sku']) : '' !!}</span>
						</td>
						<td class="text-center">{{ $item['quantity'] }}</td>
						<td class="text-center">
							@if($item['price'] < 0)
								{!! str_replace('-','-'.$settings['invoice_valuta'],formatNumber($item['price'])) !!}
							@else
								{{$settings['invoice_valuta']}} {{ formatNumber($item['price']) }}
							@endif
						</td>
						<td class="text-right">{{ $item['vat'] }}%</td>
						<td class="text-right">
							@if($item['total'] < 0)
								{!! str_replace('-','-'.$settings['invoice_valuta'],formatNumber($item['total'])) !!}
							@else
								{{$settings['invoice_valuta']}}{{ formatNumber($item['total']) }}
							@endif
						</td>
					</tr>
				@endforeach
				
				<tr>
					<td class="thick-line"></td>
					<td class="thick-line"></td>
					<td class="thick-line"></td>
					<td class="thick-line"></td>
					<td class="thick-line text-center"><strong>{{ trans('pakka::app.subtotal') }}</strong></td>
					<td class="thick-line text-right">
						@if($order['subtotal'] < 0)
							{!! str_replace('-','-'.$settings['invoice_valuta'],formatNumber($order['subtotal'])) !!}
						@else
							{{$settings['invoice_valuta']}} {{ formatNumber($order['subtotal']) }}
						@endif
					</td>
				</tr>
				<tr>
					<td class="no-line"></td>
					<td class="no-line"></td>
					<td class="no-line"></td>
					<td class="no-line"></td>
					<td class="no-line text-center"><strong>{{ trans('pakka::app.vat_short') }}</strong></td>
					<td class="no-line text-right">
						@if($order['vattotal'] < 0)
							{!! str_replace('-','-'.$settings['invoice_valuta'],formatNumber($order['vattotal'])) !!}
						@else
							{{$settings['invoice_valuta']}} {{ formatNumber($order['vattotal']) }}
						@endif
					</td>
				</tr>
				<tr>
					<td class="no-line"></td>
					<td class="no-line"></td>
					<td class="no-line"></td>
					<td class="no-line"></td>
					<td class="thick-line text-center f-14"><strong>{{ trans('pakka::app.total') }}</strong></td>
					<td class="thick-line text-right f-14">
						@if($order['total'] < 0)
							{!! str_replace('-','-'.$settings['invoice_valuta'],formatNumber($order['total'])) !!}
						@else
							{{$settings['invoice_valuta']}} {{ formatNumber($order['total']) }}
						@endif
					</td>
				</tr>
			</tbody>
		</table>
   	  	
   	  	<div>
	   	  	<h3 style="margin:20px 0px;">{{ trans('pakka::app.notes') }}:</h3>
	   	  	<p class="f-12">{!! nl2br(e($order['instructions'])) !!}</p><br>
   	  	</div>
   	  	
   	  	<footer>
	   	  	<hr>
	   	  	<table>
				<tbody>
					<tr>					
						<td valign="top" style="width:80%"><p>{{ $settings['company_name'] }} {{ $settings['company_address'] }}, {{ $settings['company_zip'] }} {{ $settings['company_city'] }} | {{ trans('pakka::app.email') }}: {{ $settings['company_email'] }} {{ trans('pakka::app.phone_short') }}: {{ $settings['company_phone'] }} | {{ $settings['company_vat'] }}</p></td>
						<td valign="top" class="t-r" style="width:20%;"><p>{{ trans('pakka::app.bc') }} {{ $settings['company_bc'] }}</p></td>
					</tr>
				</tbody>
			</table>
	   	  	
   	  	</footer>    	  	
  </body>
  
</html>