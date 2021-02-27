<!--[if mso]><table width="600" cellpadding="0" cellspacing="0"><![endif]-->
<table width="100%" style="max-width: 600px;" cellspacing="0" cellpadding="0">
	<tbody>
	    <tr>
	        <td align="center" style="padding-top: 10px; padding-bottom: 15px;">
	            <h1 style="text-align: center;"> <span style="font-size: 30px;"><b style="margin-right: 15px;">🎉</b>Hoera!<b style="margin-left: 15px;">🎊</b></span><br> We hebben jouw bestelling goed ontvangen.<br></h1>
	        </td>
	    </tr>
	    <tr>
	        <td style="padding-top: 5px; padding-bottom: 5px; " align="center"><!-- padding-right: 40px; padding-left: 40px; -->
	            <p style="color: #333333; text-align: center; margin-bottom: 0px;">Hey {{ $data['details']['firstname'] }},<br>Bedankt voor je bestelling. We verwerken jouw bestelling zo spoedig mogelijk. Hieronder vind je de details van jouw bestelling terug. Klopt er iets niet? Laat het ons weten, dan passen we het gelijk aan!<br> {{ trans('pakka::mail.greetings') }},<br>
	{{ $settings['company_name'] }}</p>
	            <p></p>
	        </td>
	    </tr>
		<tr>
	        <td align="center" style="padding-top: 10px;">
	         	@component('emails.components.buttons.primary', ['url' => url('/view/invoice').'/'.$data['invoice']['id'] ])
					Bekijk hier je factuur
				@endcomponent
	        </td>
	    </tr>
	</tbody>
</table>
<!--[if mso]></table><![endif]--> 