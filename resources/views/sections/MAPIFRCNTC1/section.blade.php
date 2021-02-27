<section class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-12 mb-5">
	            <?php
		            $settings = Session::get('settings');
		            $address = str_replace(" ", "%20", $settings['company_address'].' '.$settings['company_city']);
	            ?>
	            
                <div class="map-container e {{ parseSecAttr('.e', $section['classes']) }}">
	                <iframe src="https://maps.google.com/maps?width=100%&height=600&hl=nl&q={{$address}}+($settings['company_name'])&ie=UTF8&t=&z=14&iwloc=B&output=embed"></iframe>
	                
	                
	            </div>
            </div>
            <div class="col-md-8 col-lg-6 col-12">
                <h3>{{ $settings['company_address'] }},<br> {{ $settings['company_zip'] }} {{ $settings['company_city'] }}</h3>
                <a href="mailto:{{ $settings['company_email'] }}" class="link lead">{{ $settings['company_email'] }}</a><br>
                <a href="tel:{{ $settings['company_phone'] }}" class="link lead">{{ $settings['company_phone'] }}</a>
                <p class="lead">{{ parseContent($section['MAPIFRCNTC1_H'],'text') }}</p>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>