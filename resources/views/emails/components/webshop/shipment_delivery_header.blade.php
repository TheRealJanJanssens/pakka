<!--[if mso]><table width="600" cellpadding="0" cellspacing="0"><![endif]-->
<table width="100%" style="max-width: 600px;" cellspacing="0" cellpadding="0">
	<tbody>
	    <tr>
	        <td align="center" style="padding-top: 10px; padding-bottom: 15px;">
	            <h1 style="text-align: center;"><span style="font-size: 30px;">Je bestelling</span><br>is onderweg!<br></h1>
	        </td>
	    </tr>
	    <tr>
	        <td style="padding-top: 5px; padding-bottom: 5px; " align="center"><!-- padding-right: 40px; padding-left: 40px; -->
	            <p style="color: #333333; text-align: center; margin-bottom: 0px;">Hey {{ $data['details']['firstname'] }},<br>Je bestelling met ordernummer {{ $data['name'] }} is onderweg!<br>We hebben je pakketje verzonden @if(!empty($data['shipment']['carrier'])) met {{ trans(config('pakka.shipment_carrier.'.$data['shipment']['carrier'])) }} @endif en komt zo snel mogelijk naar je toe. Mocht je vragen hebben over je bestelling, dan helpen we je graag verder.<br> {{ trans('pakka::mail.greetings') }},<br>
	{{ $settings['company_name'] }}</p>
	            <p></p>
	        </td>
	    </tr>
	    @switch($data['shipment']['carrier'])
		    @case(2)
		        @php($url = 'http://track.bpost.be/btr/web/#/search?itemCode='.$data['shipment']['track_code'].'&lang=nl')
		        @break
			@case(3)
		        @php($url = 'https://www.dhl.be/exp-nl/express/traceren.html?AWB='.$data['shipment']['track_code'].'&brand=DHL')
		        @break
			@case(4)
		        @php($url = 'https://tracking.dpd.de/status/nl_BE/parcel/'.$data['shipment']['track_code'])
		        @break
			@case(5)
		        @php($url = null)
		        @break
			@case(6)
		        @php($url = 'https://jouw.postnl.nl/track-and-trace/'.$data['shipment']['track_code'].'-'.$data['shipment']['country'].'-'.$data['shipment']['zip'])
		        @break
			@case(7)
		        @php($url = null)
		        @break
		    @default
		        @php($url = null)
		@endswitch
		<tr>
	        <td align="center">
		        @if(!empty($url) && !empty($data['shipment']['track_code']))
		         	@component('emails.components.buttons.primary', ['url' => $url ])
						Volg je bestelling
					@endcomponent
				@endif
				<span style="display:inline-block;font-size: 12px; color: #AEAEAE;">
					@if(!empty($data['shipment']['track_code']))
						Trackingcode: {{ $data['shipment']['track_code'] }}
					@endif
				</span>
	        </td>
	    </tr>
	</tbody>
</table>
<!--[if mso]></table><![endif]-->