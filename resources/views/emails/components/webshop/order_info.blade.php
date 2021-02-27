<!-- BEGIN ORDER -->
<table cellspacing="0" cellpadding="0" align="center">
    <tbody>
        <tr>
            <td align="center">
                <!--[if mso]><table width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center"><![endif]-->
                <table width="100%" style="max-width: 600px;" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                    <tbody>
                        <tr>
                            <td align="left" style="padding-top:20px; padding-bottom: 30px;">
	                            <!--[if mso]><table width="300" cellspacing="0" cellpadding="0" align="left"><![endif]-->
                                <table width="300" cellspacing="0" cellpadding="0" align="left">
                                    <tbody>
                                        <tr>
                                            <td class="es-m-p20b esd-container-frame"  align="left">
                                                <table style="background-color: rgb(245, 248, 250); border-color: #efefef; border-collapse: separate; border-width: 1px 0px 1px 1px; border-style: solid;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fef9ef">
                                                    <tbody>
                                                        <tr>
                                                            <td align="left" style="padding-top: 20px; padding-bottom: 20px; padding-right: 20px; padding-left: 20px;">
                                                                <h4 style="margin: 0;">Je Bestelling:</h4>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align="left" style="padding-bottom: 20px; padding-right: 20px; padding-left: 20px;">
                                                                <table style="width: 100%;" cellspacing="1" cellpadding="1" border="0" align="left">
                                                                    <tbody>
	                                                                    <tr>
		                                                                    <td><h5 style="margin-bottom: 5px; margin-top: 0;">Bestelinformatie</h5></td>
	                                                                    </tr>
                                                                        <tr>
                                                                            <td><span style="font-size: 14px; line-height: 150%;">Bestelnummer:</span></td>
                                                                            <td><span style="font-size: 14px; line-height: 150%;">{{ $data['name'] }}</span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><span style="font-size: 14px; line-height: 150%;">Datum:</span></td>
                                                                            <td><span style="font-size: 14px; line-height: 150%;"><?php setlocale(LC_TIME, 'nl_NL'); echo strftime('%d %b %Y', strtotime($data['created_at'])) ?></span></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><span style="font-size: 14px; line-height: 150%;">Totaal:</span></td>
                                                                            <td><span style="font-size: 14px; line-height: 150%;">€ {{ formatNumber($data['total']) }}</span></td>
                                                                        </tr>
                                                                        <tr>
		                                                                    <td><h5 style="margin-bottom: 5px;">Facturatie</h5></td>
	                                                                    </tr>
                                                                        <tr>
                                                                            <td><span style="font-size: 14px; line-height: 150%;">Factuurnummer:</span></td>
                                                                            <td><span style="font-size: 14px; line-height: 150%;"><a href="{!! url('/view/invoice').'/'.$data['invoice']['id'] !!}" target="_blank">{{ $data['invoice']['invoice_no'] }}</a></span></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <p style="line-height: 150%;"><br></p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
								<!--[if mso]></table><![endif]-->
                                <!--[if mso]><table width="300" cellspacing="0" cellpadding="0" align="right"><![endif]-->
                                <table width="300" cellspacing="0" cellpadding="0" align="right">
                                    <tbody>
                                        <tr>
                                            <td align="left">
                                                <table style="background-color: rgb(245, 248, 250); border-collapse: separate; border-width: 1px; border-style: solid; border-color: #efefef;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fef9ef">
                                                    <tbody>
                                                        <tr>
                                                            <td class="esd-block-text" align="left" style="padding-top: 20px; padding-bottom: 20px; padding-right: 20px; padding-left: 20px;">
                                                                <h4 style="margin: 0;">Levering:<br></h4>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="esd-block-text" align="left" style="padding-bottom: 20px; padding-right: 20px; padding-left: 20px;">
	                                                            <table style="width: 100%;" cellspacing="1" cellpadding="1" border="0" align="left">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
													                            <h5 style="margin-bottom: 5px; margin-top: 0;">Levermethode:</h5>
													                        </td>
                                                                        </tr>
                                                                        <tr>
	                                                                        <td>
		                                                                        <span style="font-size: 14px; line-height: 150%;">
														                            {{ $data['shipment']['option_name'] }}
														                        </span>
	                                                                        </td>
                                                                        </tr>
                                                                        <tr>
	                                                                        <td>
		                                                                        <h5 style="margin-bottom: 5px">Leveradres:</h5>
	                                                                        </td>
                                                                        </tr>
																		<tr>
																			<td>
																				<span style="font-size: 14px; line-height: 150%; margin-bottom: 0;">
														                            {{ $data['details']['firstname'] }} {{ $data['details']['lastname'] }}
														                        </span>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<span style="font-size: 14px; line-height: 150%; margin-bottom: 0;">
														                            {{ $data['details']['address'] }}
														                        </span>
																			</td>
																		</tr>
																		<tr>
																			<td>
																				<span style="font-size: 14px; line-height: 150%; margin-bottom: 0;">
																				{{ $data['details']['zip'] }} {{ $data['details']['city'] }}, {{ $data['details']['country'] }}
														                        </span>
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
                                <!--[if mso]></td></tr></table><![endif]-->
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--[if mso]></table><![endif]-->
            </td>
        </tr>
    </tbody>
</table>
<!-- END ORDER INFO -->