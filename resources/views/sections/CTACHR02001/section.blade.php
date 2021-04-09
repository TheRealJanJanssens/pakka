<section id="{{ $section['id'] }}" class="space--xs {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="cta cta--horizontal text-center-xs row">
            <div class="col-md-9">
                <h4>{{ parseContent($section['CTACHR02001_H'],'title') }}</h4>
            </div>
            <div class="col-md-3 text-right text-center-xs">
                @if(checkContent($section['CTACHR02001_H'], 'link'))
	                <a class="btn btn--primary type--uppercase e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['CTACHR02001_H']['link'] }}">
		                <span class="btn__text">
							{{ parseContent($section['CTACHR02001_H'],'button') }}
						</span> 
					</a>
	            @endif
            </div>
        </div>
    </div>
    
    {!! constructDividers($section) !!}
</section>