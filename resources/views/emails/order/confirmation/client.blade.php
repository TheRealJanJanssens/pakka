@component('mail::message')

<!-- 

	READ THIS BEFORE EDITING:
	Due to markdown reconizing indents as a code block, therefore putting it automaticlly in pre tags, you cannot use indents. If you are seeing indents in this file they are "magic" onces. Don't know how or what they are but keep this in mind. if problem is still occuring remove all indents in this file.
	
	see link: https://github.com/laravel/framework/issues/31151#issuecomment-575619249

 -->

@component('emails.components.webshop.order_header', ['data' => $data ])
@endcomponent

@component('emails.components.webshop.order_items', ['data' => $data ])
@endcomponent

@component('emails.components.webshop.order_info', ['data' => $data ])
@endcomponent

@component('emails.components.social.social_links')
@endcomponent

<!-- BEGIN SHIPMENT -->
<!--
<table style="background-color: rgb(245, 248, 250); border-collapse: separate; border-width: 1px; border-style: solid; border-color: #efefef;" width="100%" cellspacing="0" cellpadding="0" bgcolor="#fef9ef">
    <tbody>
        <tr>
            <td class="esd-block-text" align="left" style="padding-top: 10px; padding-bottom: 20px; padding-right: 20px; padding-left: 20px;">
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
	                            <p style="font-size: 14px; line-height: 150%;">
		                            {{ $data['shipment']['option_name'] }}
		                        </p>
	                            <h5 style="margin-bottom: 5px">Leveradres:</h5>
	                            <p style="font-size: 14px; line-height: 150%; margin-bottom: 0;">
		                            {{ $data['details']['firstname'] }} {{ $data['details']['lastname'] }}<br>
		                            {{ $data['details']['address'] }}<br>
		                            {{ $data['details']['zip'] }} {{ $data['details']['city'] }}, {{ $data['details']['country'] }}
		                        </p>
	                        </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
-->
<!-- END SHIPMENT -->
@endcomponent
