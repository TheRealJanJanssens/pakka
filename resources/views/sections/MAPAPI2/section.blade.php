<section class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
	<div class="container">
	    <?php
	        $settings = Session::get('settings');
	    ?>
	    
	    <div class="map-container m-0 e {{ parseSecAttr('.e', $section['classes']) }}" data-maps-api-key="{{ config('maps.maps_api_key') }}" data-address="{{ $settings['company_address'] }} {{ $settings['company_city'] }}" data-marker_title="{{ $settings['company_name'] }}" {{ parseSecAttr('.e', $section['attributes']) }} @if(isset($section['extras']['map_style_key'])) data-map_style_key="{{ $section['extras']['map_style_key'] }}" data-map_style="{{ config( $section['extras']['map_style_key'] ) }}" @endif @if(isset($section['extras']['map_zoom'])) data-map_zoom="{{ $section['extras']['map_zoom'] }}" @endif></div>
	</div>
{!! constructDividers($section) !!}
</section>