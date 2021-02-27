<section class="switchable imagebg {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="background-image-holder"> <img alt="background" {{ parseImage($section['TXTBG4_BIMG'], $section['TXTBG4_BIMG']['images'][0], 2500) }}> </div>
    <div class="container">
		
	    <h2 class="mb-10">{{ parseContent($section['TXTBG4_HEAD'],'title') }}</h2>

        <div class="row">
            <div class="col-md-6">
                <h4>{{ parseContent($section['TXTBG4_C1'],'title') }}</h4>
                <p>{{ parseContent($section['TXTBG4_C1'],'text') }}</p>
                @if(checkContent($section['TXTBG4_C1'], 'link'))
	                <a href="{{ parseContent($section['TXTBG4_C1'],'link') }}" class="btn">
		                {{ parseContent($section['TXTBG4_C1'],'button') }}
		            </a>
	            @endif
            </div>
            <div class="col-md-6">
                <h4>{{ parseContent($section['TXTBG4_C2'],'title') }}</h4>
                <p>{{ parseContent($section['TXTBG4_C2'],'text') }}</p>
                @if(checkContent($section['TXTBG4_C2'], 'link'))
	                <a href="{{ parseContent($section['TXTBG4_C2'],'link') }}" class="btn">
		                {{ parseContent($section['TXTBG4_C2'],'button') }}
		            </a>
	            @endif
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>