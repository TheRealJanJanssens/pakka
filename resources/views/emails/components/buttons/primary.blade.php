<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top: 20px; margin-bottom: 20px;">
    <tr>
        <td align="center">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
	                    <!--[if mso]><span style="border-radius: 5px; background-color: #0384f3; padding: 10px;"><![endif]-->
                        <span style="border-radius: 5px; background: {{ $settings['primary_color'] }} none repeat scroll 0% 0%; background-color: {{ $settings['primary_color'] }}; padding: 10px;">
							<a href="{{ $url }}" target="_blank" style="font-size: 16px; text-decoration: none; color: #ffffff;">{{ $slot }}</a>
						</span>
						<!--[if mso]></span><![endif]-->
					</td>
                </tr>
            </table>
        </td>
    </tr>
</table>