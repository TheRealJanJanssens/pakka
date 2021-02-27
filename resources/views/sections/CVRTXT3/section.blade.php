<section id="{{ $section['id'] }}" class="cover imagebg {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    
    @if(!empty($section['CVRTXT3_BIMG']['images']) && count($section['CVRTXT3_BIMG']['images']) > 1)
    	<div class="slider background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}" data-autoplay="true" data-fade="true" {{ parseSecAttr('.slider', $section['attributes']) }}>
            @foreach($section['CVRTXT3_BIMG']['images'] as $image)
                <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
					<img alt="background" {{ parseImage($section['CVRTXT3_BIMG'], $image, 2500) }}>
                </div>
            @endforeach 
        </div>
    @else
    	<div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
    		<img alt="background" {{ parseImage($section['CVRTXT3_BIMG'], $section['CVRTXT3_BIMG']['images'][0], 2500) }}> 
    	</div>
    @endif
    
    <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}"> <img alt="background" {{ parseImage($section['CVRTXT3_BIMG'], $section['CVRTXT3_BIMG']['images'][0], 2500) }}> </div>
    
    <div class="container pos-vertical-center">
        <div class="row">
            <div class="col-md-12"> <img alt="Image" class="img {{ parseSecAttr('.img', $section['classes']) }}" {{ parseImage($section['CVRTXT3_H'], $section['CVRTXT3_H']['images'][0], 2500) }}>
                <h3>{{ parseContent($section['CVRTXT3_H'],'title') }}</h3> <!-- unmarg--bottom -->
                

	            @if(checkContent($section['CVRTXT3_H'], 'link'))
	                <a class="btn btn--primary type--uppercase e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['CVRTXT3_H']['link'] }}">
		                <span class="btn__text">
							{{ parseContent($section['CVRTXT3_H'],'button') }}
						</span> 
					</a>
	            @endif
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>