<section class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 col-12 mb-5">
	            <?php
			        $settings = Session::get('settings');
			    ?>
			    
			    <div class="map-container m-0 e {{ parseSecAttr('.e', $section['classes']) }}" data-maps-api-key="{{ config('maps.maps_api_key') }}" data-address="{{ $settings['company_address'] }} {{ $settings['company_city'] }}" data-marker-title="{{ $settings['company_name'] }}" {{ parseSecAttr('.e', $section['attributes']) }} @if(isset($section['extras']['map_style_key'])) data-map-style-key="{{ $section['extras']['map_style_key'] }}" data-map-style="{{ config( $section['extras']['map_style_key'] ) }}" @endif></div>
		    </div>
		    
            <div class="col-md-8 col-lg-6 col-12">
                <h3>{{ $settings['company_address'] }},<br> {{ $settings['company_zip'] }} {{ $settings['company_city'] }}</h3>
                <a href="mailto:{{ $settings['company_email'] }}" class="link lead">{{ $settings['company_email'] }}</a><br>
                <a href="tel:{{ $settings['company_phone'] }}" class="link lead">{{ $settings['company_phone'] }}</a>
                <p class="lead">{{ parseContent($section['MAPAPICNTC1_H'],'text') }}</p>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>