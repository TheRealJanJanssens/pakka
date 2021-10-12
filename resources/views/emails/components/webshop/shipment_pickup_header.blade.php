<!--[if mso]><table width="600" cellpadding="0" cellspacing="0"><![endif]-->
<table width="100%" style="max-width: 600px;" cellspacing="0" cellpadding="0">
	<tbody>
	    <tr>
	        <td align="center" style="padding-top: 10px; padding-bottom: 15px;">
	            <h1 style="text-align: center;"><span style="font-size: 30px;">Je bestelling</span><br>is klaar om afgehaald te worden!<br></h1>
	        </td>
	    </tr>
	    <tr>
	        <td style="padding-top: 5px; padding-bottom: 5px; " align="center"><!-- padding-right: 40px; padding-left: 40px; -->
	            <p style="color: #333333; text-align: center; margin-bottom: 0px;">Hey {{ $data['details']['firstname'] }},<br>Je bestelling met ordernummer {{ $data['name'] }} is klaar om afgehaald te worden! Bekijk onze openingsuren voor wanneer je jouw pakketje kunt afhalen.<br> {{ trans('pakka::mail.greetings') }},<br>
	{{ $settings['company_name'] }}</p>
	            <p></p>
	        </td>
	    </tr>
	<!--
	    <tr>
	        <td align="center" style="padding-top: 10px;">
	         	@component('pakka::emails.components.buttons.primary', ['url' => url('/view/invoice').'/'.$data['invoice']['id'] ])
					Bekijk hier je factuur
				@endcomponent
	        </td>
	    </tr>
	-->
	</tbody>
</table>
<!--[if mso]></table><![endif]--> 
<!-- http://track.bpost.be/btr/web/#/search?itemCode=323211191400006285879030&lang=nl -->
<!-- https://tracking.dpd.de/status/nl_BE/parcel/123456789 -->
<!-- https://www.dhl.be/exp-nl/express/traceren.html?AWB=6546415466&brand=DHL -->
<!-- https://jouw.postnl.nl/track-and-trace/65465464987987-BE-2960 -->