<section class="imagebg videobg {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="youtube-background" data-video-url="{{ parseSecAttr('youtube', $section['extras']) }}"></div> <!-- data-start-at="17" -->
    <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}"> <img alt="background" {{ parseImage($section['CVRVID1_BIMG'], $section['CVRVID1_BIMG']['images'][0], 2500) }}> </div>
    <div class="container pos-vertical-center">
        <div class="row">
            <div class="col-md-8 col-lg-7">
                <h1>{{ parseContent($section['CVRVID1_H'],'title') }}</h1>
                <p class="lead"> {{ parseContent($section['CVRVID1_H'],'text') }} </p>
                <a class="btn btn--primary type--uppercase e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['CVRVID1_H']['link'] }}">
	                <span class="btn__text">
						{{ parseContent($section['CVRVID1_H'],'button') }}
					</span> 
				</a>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>