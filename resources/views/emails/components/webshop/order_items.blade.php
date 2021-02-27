<!-- BEGIN ORDER ITEMS -->
<table cellspacing="0" cellpadding="0" align="center" style="margin-bottom: 20px;">
    <tbody>
        <tr>
            <td align="center">
	            <!--[if mso]><table width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center"><![endif]-->
                <table width="100%" style="max-width: 600px;" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center">
                    <tbody>
                        <tr>
                            <td align="left" style="padding-top: 10px; padding-bottom: 10px; padding-right: 20px; ">
                                <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
                                <table cellspacing="0" cellpadding="0" align="left">
                                    <tbody>
                                        <tr>
                                            <td width="270" valign="top" align="center">
                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="left">
	                                                            <?php 
		                                                            $i=0;
		                                                            foreach($data['items'] as $item){
			                                                            if(!empty($item['product_id'])){
				                                                            $i++;
			                                                            }
		                                                            }
		                                                        ?>
		                                                        @if($i == 1)
			                                                    	<h4 style="margin-top: 0px; margin-bottom: 0px;">{{ $i }} Artikel</h4>        
		                                                        @else
			                                                    	<h4 style="margin-top: 0px; margin-bottom: 0px;">{{ $i }} Artikelen</h4>        
		                                                        @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->                              
<!--
								<table style="width: 100%;" cellspacing="1" cellpadding="1" border="0" align="left">
									<tbody>
										<tr>
											<td></td>
											<td>name</td>
                                            <td style="text-align: center;" width="60">aantal</td>
                                            <td style="text-align: center;" width="100">$20.00</td>
										</tr>
									</tbody>
								</table>
-->
                                <!--[if mso]></td></tr></table><![endif]-->
                            </td>
                        </tr>
                        <tr>
                            <td align="left">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td width="560" valign="top" align="center">
                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="es-p10b" align="center" style="font-size:0">
                                                                <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="border-bottom: 1px solid #efefef; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;"></td>
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
                            </td>
                        </tr>
                        <?php
	                        foreach($data['items'] as $item){
		                        //$price = $item['price']*$item['quantity'];
								$price = formatNumber($item['price']);
								
								switch (true) {
								    case $price < 0:
								        $price = str_replace('-', '-€', $price);
								        break;
								    case $price == 0:
								        $price = "<span style='color:".$settings['primary_color'].";'>Gratis</span>";
								        break;
								    case $price > 0:
								        $price = "€".$price;
								        break;
								}
	                    ?>
	                        <tr>
	                            <td align="left">
	                                <?php
		                                if(!empty($item['product_id'])){
			                                $image = App\Images::where('item_id', $item['product_id'])->orderBy('position')->first();
		                                ?>
		                                <!--[if mso]><table width="560" cellpadding="0" cellspacing="0"><tr><td width="178" valign="top"><![endif]-->
		                                <table cellspacing="0" cellpadding="0" align="left">
		                                    <tbody>
		                                        <tr>
		                                            <td width="150" valign="middle" align="center">
		                                                <table width="100%" cellspacing="0" cellpadding="0">
		                                                    <tbody>
		                                                        <tr>
		                                                            <td valign="middle" align="left" style="font-size:0">
			                                                            <span style="display: block; margin-top: 20px;"></span>
			                                                            @if(isset($image->item_id))
			                                                            	<a href="{!! url('/'.$settings['role_product_detail'].'/'.$item['product_id']) !!}" target="_blank">
				                                                            	<img src="{!! url('/').imgUrl($image->item_id, $image->file, 100) !!}" alt="{!! $item['name'] !!}" title="{!! $item['name'] !!}" width="130">
				                                                            </a>
																		@endif
				                                                        <span style="display: block; margin-top: 20px;"></span>
			                                                        </td>
		                                                        </tr>
		                                                    </tbody>
		                                                </table>
		                                            </td>
		                                        </tr>
		                                    </tbody>
		                                </table>
										<!--[if mso]></td><td width="20"></td><![endif]-->
		                                <?php
			                                $info_width = 450;
			                            }else{
				                            $info_width = 600;
			                            }
	                                ?>
	                                <!--[if mso]><td width="{{ $info_width }}" valign="top"><![endif]-->
	                                <table cellspacing="0" cellpadding="0" align="right">
	                                    <tbody>
	                                        <tr>
	                                            <td width="{{ $info_width }}" align="left">
	                                                <table width="100%" cellspacing="0" cellpadding="0">
	                                                    <tbody>
	                                                        <tr>
	                                                            <td align="left">
		                                                            @if(!empty($item['product_id']))
	                                                                	<span style="display: block; margin-top: 20px;"></span>
																	@else
																		<span style="display: block; margin-top: 5px;"></span>
	                                                                @endif
	                                                                <table style="width: 100%;" class="cke_show_border" cellspacing="1" cellpadding="1" border="0">
	                                                                    <tbody>
	                                                                        <tr>
	                                                                            <td>
		                                                                            @if(!empty($item['product_id']))
		                                                                            <a href="{!! url('/'.$settings['role_product_detail'].'/'.$item['product_id']) !!}" target="_blank" style="text-decoration: none;">
			                                                                            <span style="display:inline-block; color:#55585d;">{!! $item['name'] !!}</span>
			                                                                            @if(!empty($item['sku']))
			                                                                            <br><span style="display:inline-block;font-size: 12px; color: #AEAEAE;">{{ $item['sku'] }}</span>
			                                                                            @endif
			                                                                            <br><span style="display:inline-block;font-weight: 900; font-size: 18px; margin-top: 5px; margin-bottom: 15px; color:#55585d;">{!! $price !!}</span>
			                                                                            <br><span style="display: inline-block; font-size: 14px; color:#55585d;"><b>Aantal:</b> {{ $item['quantity'] }}</span>
			                                                                        </a>
			                                                                        @else
			                                                                        	<span style="font-size: 14px;">{{ $item['name'] }}</span>
		                                                                            @endif
		                                                                        </td>
	                                                                            <td style="text-align: right; font-size: 14px;" width="100">
		                                                                            @if(empty($item['product_id']))
		                                                                            	{!! $price !!}
		                                                                            @endif
	                                                                            </td>
	                                                                        </tr>
	                                                                    </tbody>
	                                                                </table>
	                                                                @if(!empty($item['product_id']))
	                                                                	<span style="display: block; margin-top: 20px;"></span>
																	@else
																		<span style="display: block; margin-top: 5px;"></span>
	                                                                @endif
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
	                        <tr>
	                            <td align="left">
	                                <table width="100%" cellspacing="0" cellpadding="0">
	                                    <tbody>
	                                        <tr>
	                                            <td width="560" valign="top" align="center">
	                                                <table width="100%" cellspacing="0" cellpadding="0">
	                                                    <tbody>
	                                                        <tr>
	                                                            <td align="center" style="font-size:0">
	                                                                <table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
	                                                                    <tbody>
	                                                                        <tr>
	                                                                            <td style="border-bottom: 1px solid #efefef; background: rgba(0, 0, 0, 0) none repeat scroll 0% 0%; height: 1px; width: 100%; margin: 0px;"></td>
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
	                            </td>
	                        </tr>
							<?php
							}
                        ?>
                        <tr>
                            <td align="left">
                                <table width="100%" cellspacing="0" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <td width="600" valign="top" align="center">
                                                <table width="100%" cellspacing="0" cellpadding="0">
                                                    <tbody>
                                                        <tr>
                                                            <td align="right">
                                                                <table style="width: 600px;" cellspacing="1" cellpadding="1" border="0" align="right">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td style="text-align: left; font-size: 18px; line-height: 150%;">Subtotaal (Excl. BTW):</td>
                                                                            <td style="text-align: right; font-size: 18px; line-height: 150%;">€{{ formatNumber($data['subtotal']) }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: left; font-size: 18px; line-height: 150%;">BTW:</td>
                                                                            <td style="text-align: right; font-size: 18px; line-height: 150%;">€{{ formatNumber($data['vattotal']) }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: left; font-size: 18px; line-height: 150%;"><strong>Totaal:</strong></td>
                                                                            <td style="text-align: right; font-size: 18px; line-height: 150%; color: {{ $settings['primary_color'] }};"><strong>€{{ formatNumber($data['total']) }}</strong></td>
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
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--[if mso]></table><![endif]-->
            </td>
        </tr>
    </tbody>
</table>
<!-- END ORDER ITEMS -->