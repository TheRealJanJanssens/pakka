<section class="switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6 col-md-7 col-12">
	            <?php
		            $settings = Session::get('settings');
	            ?>
	            
                <div class="map-container e {{ parseSecAttr('.e', $section['classes']) }}" data-maps-api-key="{{ config('maps.maps_api_key') }}" data-address="{{ $settings['company_address'] }} {{ $settings['company_city'] }}" data-marker-title="{{ $settings['company_name'] }}" {{ parseSecAttr('.e', $section['attributes']) }} @if(isset($section['extras']['map_style_key'])) data-map-style-key="{{ $section['extras']['map_style_key'] }}" data-map-style="{{ config( $section['extras']['map_style_key'] ) }}" @endif></div>
            </div>
            <div class="col-lg-5 col-md-5">
                <div class="switchable__text">
                    <h3>{{ parseContent($section['MAPTXT1_H'],'title') }}</h3>
                    <p class="lead">{{ parseContent($section['MAPTXT1_H'],'text') }}</p>
                </div>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>