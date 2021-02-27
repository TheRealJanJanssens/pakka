<section class="unpad {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
	
	<?php
        $settings = Session::get('settings');
        $address = str_replace(" ", "%20", $settings['company_address'].' '.$settings['company_city']);
    ?>
	
    <div class="map-container m-0 e {{ parseSecAttr('.e', $section['classes']) }}">
        <iframe src="https://maps.google.com/maps?width=100%&height=600&hl=nl&q={{$address}}+($settings['company_name'])&ie=UTF8&t=&z=14&iwloc=B&output=embed"></iframe>
    </div>
{!! constructDividers($section) !!}
</section>