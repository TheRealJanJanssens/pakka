<section id="{{ $section['id'] }}" class="switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-between {{ parseSecAttr('.row', $section['classes']) }}">
            <div class="col-md-6 adaptable__text">
	            @if(checkContent($section['PRCPST02001_HEAD'], 'title'))
			    	<h2>{{ parseContent($section['PRCPST02001_HEAD'],'title') }}</h2>
			    @endif
			    
			    @if(checkContent($section['PRCPST02001_HEAD'], 'text'))
			    	<p class="lead">{{ parseContent($section['PRCPST02001_HEAD'],'text') }}</p>
			    @endif
            </div>

            <div class="col-lg-5 col-md-6 text-center">
	            <div class="pricing pricing-1 boxed boxed--lg e {{ parseSecAttr('.e', $section['classes']) }}"> <!-- boxed--emphasis -->
                    <h4>{{ parseContent($section['PRCPST02001_C1'],'title') }}</h4>

                    @if(!empty($section['PRCPST02001_C1']['price']) || checkEditAcces())
				    	 <span class="h1">
	                    	<span class="pricing__valuta">{{ $settings['invoice_valuta'] }}</span>
	                    	{{ parseContent($section['PRCPST02001_C1'],'price') }}
	                    </span>
				    @endif
                    
                    <p>{{ parseContent($section['PRCPST02001_C1'],'text') }}</p> 
<!--                     <span class="label">Value</span> -->

					@if(checkLink($section['PRCPST02001_C1']['link']) || checkEditAcces())
		                <a class="btn btn--primary"  href="{{ $section['PRCPST02001_C1']['link'] }}">
			                <span class="btn__text">
								{{ parseContent($section['PRCPST02001_C1'],'button') }}
							</span> 
						</a>
		            @endif
                </div>
	        </div>
            
        </div>
    </div>
{!! constructDividers($section) !!}
</section>