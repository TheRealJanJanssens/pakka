@component('mail::message')

	@component('emails.components.webshop.order_info', ['data' => $data ])
	@endcomponent
	
	<!--[if mso]><table width="600" cellpadding="0" cellspacing="0"><![endif]-->
	<table width="100%" style="max-width: 600px; margin-top: -20px;">
		<tbody>
			<tr>
				<td align="center">
					@php($url = url('/admin/orders').'/'.$data['id'])
					@if(!empty($url))
						@component('emails.components.buttons.primary', ['url' => $url ])
							Open bestelling in beheerpaneel
						@endcomponent
					@endif
				</td>
			</tr>
		</tbody>
	</table>
	<!--[if mso]></table><![endif]-->	
	@component('emails.components.webshop.order_items', ['data' => $data ])
	@endcomponent

@endcomponent
