<section class="cover imagebg {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
     
	    @if(!empty($section['CVR1_BIMG']['images']) && count($section['CVR1_BIMG']['images']) > 1)
        	<div class="slider background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}" data-autoplay="true" data-fade="true" {{ parseSecAttr('.slider', $section['attributes']) }}>
                @foreach($section['CVR1_BIMG']['images'] as $image)
	                <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
						<img alt="background" {{ parseImage($section['CVR1_BIMG'], $image, 2500) }}>
	                </div>
                @endforeach 
            </div>
        @else
        	<div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
        		<img alt="background" {{ parseImage($section['CVR1_BIMG'], $section['CVR1_BIMG']['images'][0], 2500) }}> 
        	</div>
        @endif
	</div>
{!! constructDividers($section) !!}
</section>