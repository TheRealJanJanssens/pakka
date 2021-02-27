<section id="{{ $section['id'] }}" class="imageblock switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="imageblock__content col-lg-6 col-md-4 pos-right">
        <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}"> <img alt="background" {{ parseImage($section['CVRTXT4_BIMG'], $section['CVRTXT4_BIMG']['images'][0], 1500) }}> </div>
    </div>
    <div class="container pos-vertical-center">
        <div class="row--e {{ parseSecAttr('.row--e', $section['classes']) }}">
            <div class="col-lg-5 col-md-7">
                <h1>{{ parseContent($section['CVRTXT4_H'],'title') }}</h1>
                <p class="lead">{{ parseContent($section['CVRTXT4_H'],'text') }}</p>
                
                @if(checkContent($section['CVRTXT4_H'], 'link'))
	                <a class="btn btn--primary type--uppercase e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['CVRTXT4_H']['link'] }}">
		                <span class="btn__text">
							{{ parseContent($section['CVRTXT4_H'],'button') }}
						</span> 
					</a>
	            @endif
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>