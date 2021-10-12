@component('mail::message')

<!-- 

	READ THIS BEFORE EDITING:
	Due to markdown reconizing indents as a code block, therefore putting it automaticlly in pre tags, you cannot use indents. If you are seeing indents in this file they are "magic" onces. Don't know how or what they are but keep this in mind. if problem is still occuring remove all indents in this file.
	
	see link: https://github.com/laravel/framework/issues/31151#issuecomment-575619249

 -->

@if($data['shipment']['option']['delivery'] == 0)

@component('pakka::emails.components.webshop.shipment_pickup_header', ['data' => $data ])
@endcomponent

@else

@component('pakka::emails.components.webshop.shipment_delivery_header', ['data' => $data ])
@endcomponent

@endif

@component('pakka::emails.components.webshop.order_items', ['data' => $data ])
@endcomponent

@component('pakka::emails.components.social.social_links')
@endcomponent

@endcomponent
