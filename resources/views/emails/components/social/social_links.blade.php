<!-- BEGIN SOCIAL MEDIA -->
@php( $social_links = constructSocialMediaLinks() )
@if( !empty($social_links) )
<table cellspacing="0" cellpadding="0" align="center">
    <tbody>
        <tr>
			<td align="center">
				<!--[if mso]><table width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center"><![endif]-->
                <table width="100%" style="max-width: 600px;" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                    <tbody>
                        <tr>
                            <td style="padding-top: 10px; padding-right: 20px; padding-left: 20px;" align="left">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td width="560" valign="top" align="center">
                                                <table style="border-radius: 0px; border-collapse: separate;" width="100%" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center">
                                                                <h2 style="text-align: center;">Volg ons op social media!</h2>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-bottom: 5px; padding-right: 40px; padding-left: 40px;" align="center">
                                                                @foreach($social_links as $link)
                                                                	@if(!empty($link['email_icon']))
                                                                		<a href="{{ $link['link'] }}" target="_blank" title="{{ $link['name'] }}" style="margin-left: 5px; margin-right: 5px;">
	                                                                		<img src="{!! url('/images/mail/icons').'/'.$link['email_icon'] !!}" alt="{{ $link['name'] }}" title="{{ $link['name'] }}">
	                                                                	</a>
                                                                	@endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--[if mso]></table><![endif]-->
            </td>
        </tr>
    </tbody>
</table>
@endif
<!-- END SOCIAL MEDIA -->