<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
	    
	    @if(isset($section['PRCPST01002_HEAD']['title']) || checkEditAcces())
	    	<h2>{{ parseContent($section['PRCPST01002_HEAD'],'title') }}</h2>
	    @endif
	    
        <div class="row">
	        
            <div class="col-md-6">
                <div class="pricing pricing-1 boxed boxed--lg e {{ parseSecAttr('.e', $section['classes']) }}"> <!-- boxed--emphasis -->
                    <h4>{{ parseContent($section['PRCPST01002_C1'],'title') }}</h4>

                    @if(!empty($section['PRCPST01002_C1']['price']) || checkEditAcces())
				    	 <span class="h1">
	                    	<span class="pricing__valuta">{{ $settings['invoice_valuta'] }}</span>
	                    	{{ parseContent($section['PRCPST01002_C1'],'price') }}
	                    </span>
				    @endif
                    
                    <p>{{ parseContent($section['PRCPST01002_C1'],'text') }}</p> 
<!--                     <span class="label">Value</span> -->

					@if(checkLink($section['PRCPST01002_C1']['link']) || checkEditAcces())
		                <a class="btn btn--primary"  href="{{ $section['PRCPST01002_C1']['link'] }}">
			                <span class="btn__text">
								{{ parseContent($section['PRCPST01002_C1'],'button') }}
							</span> 
						</a>
		            @endif
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="pricing pricing-1 boxed boxed--lg e {{ parseSecAttr('.e', $section['classes']) }}"> <!-- boxed--emphasis -->
                    <h4>{{ parseContent($section['PRCPST01002_C2'],'title') }}</h4>
                    
                    @if(!empty($section['PRCPST01002_C2']['price']) || checkEditAcces())
				    	 <span class="h1">
	                    	<span class="pricing__valuta">{{ $settings['invoice_valuta'] }}</span>
	                    	{{ parseContent($section['PRCPST01002_C2'],'price') }}
	                    </span>
				    @endif
                    
                    <p>{{ parseContent($section['PRCPST01002_C2'],'text') }}</p> 
<!--                     <span class="label">Value</span> -->

					@if(checkLink($section['PRCPST01002_C2']['link']) || checkEditAcces())
		                <a class="btn btn--primary" href="{{ $section['PRCPST01002_C2']['link'] }}">
			                <span class="btn__text">
								{{ parseContent($section['PRCPST01002_C2'],'button') }}
							</span> 
						</a>
		            @endif
                </div>
            </div>
            
        </div>
        
        @if(isset($section['PRCPST01002_DIS']['text']) || checkEditAcces())
        	<p>{{ parseContent($section['PRCPST01002_DIS'],'text') }}</p>
        @endif
        
    </div>
{!! constructDividers($section) !!}
</section>