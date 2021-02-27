@component('mail::message')

# {{ trans('pakka::mail.contact_submission') }}

{{ trans('pakka::mail.dear') }},<br>

<?php
	if(!isset($data['construct_company_mail'])){
		echo trans('pakka::mail.thanks_for_sending')."<br>";
	}
	
	$exclude = array('url','captcha','construct_company_mail');

	foreach($data as $key => $value){
		if(!contains($key,$exclude)){
			echo "**".ucfirst(str_replace('_', ' ', $key))."**: ".$value."<br>";
		}
	}
?>

<!--
@component('mail::button', ['url' => ''])
Button Text
@endcomponent
-->

{{ trans('pakka::mail.greetings') }},<br>
{{ $settings['company_name'] }}
@endcomponent
