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
						<?php
							$key = $invoice['type'];
							$types = config("pakka.document_type");
							$invoice['type'] = trans($types[$key]);	
						?>
						<h1 class="d-b" style="font-size:35px;margin-top: 15px;">{{ $invoice['type'] }}</h1>
						@if($key !== 3)
							<p class="f-18 f-light">{{ $invoice['invoice_no'] }}</p>
						@endif
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
						@if(!empty($invoice['ship_address']))
							<b class="d-b f-light">{{ trans('pakka::app.invoiced_to') }}:</b>
							<b class="f-12">{{ $invoice['client_name'] }}</b>
							<p>{{ $invoice['client_address'] }}</p>
							<p>{{ $invoice['client_zip'] }} {{ $invoice['client_city'] }}</p>
							<p>{{ $invoice['client_country'] }}</p>
							<p>{{ $invoice['client_email'] }}</p>
							<p>{{ $invoice['client_phone'] }}</p>
							<p>{{ $invoice['client_vat'] }}</p>
							
							<b class="d-b f-light" style="margin-top: 20px;">{{ trans('pakka::app.sended_to') }}:</b>
							<p>{{ $invoice['ship_address'] }}</p>
							<p>{{ $invoice['ship_zip'] }} {{ $invoice['ship_city'] }}</p>
							<p>{{ $invoice['ship_country'] }}</p>
						@else
							<b class="f-12">{{ $invoice['client_name'] }}</b>
							<p>{{ $invoice['client_address'] }}</p>
							<p>{{ $invoice['client_zip'] }} {{ $invoice['client_city'] }}</p>
							<p>{{ $invoice['client_country'] }}</p>
							<p>{{ $invoice['client_email'] }}</p>
							<p>{{ $invoice['client_phone'] }}</p>
							<p>{{ $invoice['client_vat'] }}</p>
						@endif
					</td>
				</tr>
			</tbody>
		</table>
		
		<hr>
		
		<table class="f-11" style="margin-bottom: 15px;">
			<tbody>
				<tr>
					<td valign="top">
						<p><b>{{ trans('pakka::app.invoice_no') }}:</b> {{ $invoice['invoice_no'] }}</p>
					</td>
					
					<td valign="top">
						<p><b>{{ trans('pakka::app.date') }}:</b> {{ $invoice['date'] }}</p>
					</td>
					
					<td valign="top">
						<p><b>{{ trans('pakka::app.due_date') }}:</b> {{ $invoice['due_date'] }}</p>
					</td>
				</tr>
			</tbody>
		</table>

	   <table class="table invoice-table table-condensed">
			<thead>
                <tr>
	                <td class="text-center"><strong>{{ trans('pakka::app.description') }}</strong></td>
					<td><strong>{{ trans('pakka::app.quantity') }}</strong></td>
					<td class="text-center"><strong>{{ trans('pakka::app.price') }}</strong></td>
					<td class="text-right"><strong>{{ trans('pakka::app.vatper') }}</strong></td>
					<td class="text-right"><strong>{{ trans('pakka::app.total') }}</strong></td>
                </tr>
			</thead>
			<tbody class="f-12">
				@foreach($invoice['items'] as $item)
					<tr>
						<td>{{ $item['name'] }}</td>
						<td class="text-center">{{ $item['quantity'] }}</td>
						<td class="text-center">
							@if($item['price'] < 0)
								{!! str_replace('-','-'.$settings['invoice_valuta'],$item['price']) !!}
							@else
								{{$settings['invoice_valuta']}} {{ $item['price'] }}
							@endif
						</td>
						<td class="text-right">{{ $item['vat'] }}%</td>
						<td class="text-right">
							@if($item['total'] < 0)
								{!! str_replace('-','-'.$settings['invoice_valuta'],$item['total']) !!}
							@else
								{{$settings['invoice_valuta']}}{{ $item['total'] }}
							@endif
						</td>
					</tr>
				@endforeach
				
				<tr>
					<td class="thick-line"></td>
					<td class="thick-line"></td>
					<td class="thick-line"></td>
					<td class="thick-line text-center"><strong>{{ trans('pakka::app.subtotal') }}</strong></td>
					<td class="thick-line text-right">
						@if($invoice['subtotal'] < 0)
							{!! str_replace('-','-'.$settings['invoice_valuta'],$invoice['subtotal']) !!}
						@else
							{{$settings['invoice_valuta']}} {{ $invoice['subtotal'] }}
						@endif
					</td>
				</tr>
				<tr>
					<td class="no-line"></td>
					<td class="no-line"></td>
					<td class="no-line"></td>
					<td class="no-line text-center"><strong>{{ trans('pakka::app.vat_short') }}</strong></td>
					<td class="no-line text-right">
						@if($invoice['vattotal'] < 0)
							{!! str_replace('-','-'.$settings['invoice_valuta'],$invoice['vattotal']) !!}
						@else
							{{$settings['invoice_valuta']}} {{ $invoice['vattotal'] }}
						@endif
					</td>
				</tr>
				<tr>
					<td class="no-line"></td>
					<td class="no-line"></td>
					<td class="no-line"></td>
					<td class="thick-line text-center f-14"><strong>{{ trans('pakka::app.total') }}</strong></td>
					<td class="thick-line text-right f-14">
						@if($invoice['total'] < 0)
							{!! str_replace('-','-'.$settings['invoice_valuta'],$invoice['total']) !!}
						@else
							{{$settings['invoice_valuta']}} {{ $invoice['total'] }}
						@endif
					</td>
				</tr>
			</tbody>
		</table>
   	  	
   	  	<div>
	   	  	<h3 style="margin:20px 0px;">Toelichting:</h3>
	   	  	<p class="f-12">{{ $invoice['description'] }}</p>
	   	  	<p class="f-12">{{ trans('pakka::app.make_payment') }} <br>{{ trans('pakka::app.iban') }}: {{ $settings['company_iban'] }}</p>
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