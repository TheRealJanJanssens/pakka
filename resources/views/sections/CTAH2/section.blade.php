<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="cta cta-1 cta--horizontal boxed boxed--border text-center-xs e {{ parseSecAttr('.e', $section['classes']) }}">
                    <div class="row justify-content-center p-5">
                        <div class="col-lg-3">
                            <h4>{{ parseContent($section['CTAH2_H'],'title') }}</h4>
                        </div>
                        <div class="col-lg-4">
                            <p class="lead">{{ parseContent($section['CTAH2_H'],'text') }}</p>
                        </div>
                        <div class="col-lg-4 text-center">
                            @if(checkContent($section['CTAH2_H'], 'link'))
				                <a class="btn btn--primary type--uppercase e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['CTAH2_H']['link'] }}">
					                <span class="btn__text">
										{{ parseContent($section['CTAH2_H'],'button') }}
									</span> 
								</a>
				            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>