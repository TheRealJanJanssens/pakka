<section class="imagebg videobg {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
	<div class="youtube-background" data-video-url="{{ parseSecAttr('youtube', $section['extras']) }}"></div> <!-- data-start-at="17" -->
    <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}"> <img alt="background" {{ parseImage($section['HEROVD02001_BIMG'], $section['HEROVD02001_BIMG']['images'][0], 2500) }}> </div>
    <div class="container pos-vertical-center">
        <div class="row">
            <div class="col-md-12"> 
	            
	            @if(checkContent($section['HEROVD02001_H'], 'images'))
	            <img alt="Image" class="unmarg--bottom" {{ parseImage($section['HEROVD02001_H'], $section['HEROVD02001_H']['images'][0], 300) }}>
	            @endif
	            
	            @if(checkContent($section['HEROVD02001_H'], 'text'))
                	<h3 class="mt-2">{{ parseContent($section['HEROVD02001_H'],'text') }}</h3>
                @endif
                
                @if(checkContent($section['HEROVD02001_H'], 'link'))
                	<a class="btn btn--primary type--uppercase" href="{{ $section['HEROVD02001_H']['link'] }}">
		               	<span class="btn__text">
							{{ parseContent($section['HEROVD02001_H'],'button') }}
						</span> 
					</a>
                @endif
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>