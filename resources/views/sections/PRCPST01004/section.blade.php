<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">

	    @if(checkContent($section['PRCPST01004_HEAD'], 'title'))
	    	<h2>{{ parseContent($section['PRCPST01004_HEAD'],'title') }}</h2>
	    @endif
	    
        <div class="row">
	        
            <div class="col-md-3">
                <div class="pricing pricing-1 boxed boxed--border boxed--lg e {{ parseSecAttr('.e', $section['classes']) }}"> <!-- boxed--emphasis -->
                    <h4>{{ parseContent($section['PRCPST01004_C1'],'title') }}</h4>
                    
                    @if(checkContent($section['PRCPST01004_C1'], 'price'))
				    	 <span class="h1">
	                    	<span class="pricing__valuta">{{ $settings['invoice_valuta'] }}</span>
	                    	{{ parseContent($section['PRCPST01004_C1'],'price') }}
	                    </span>
				    @endif
                    
                    <p>{{ parseContent($section['PRCPST01004_C1'],'text') }}</p> 
<!--                     <span class="label">Value</span> -->

					@if(checkLink($section['PRCPST01004_C1']['link']) || checkEditAcces())
		                <a class="btn btn--primary"  href="{{ $section['PRCPST01004_C1']['link'] }}">
			                <span class="btn__text">
								{{ parseContent($section['PRCPST01004_C1'],'button') }}
							</span> 
						</a>
		            @endif
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="pricing pricing-1 boxed boxed--border boxed--lg e {{ parseSecAttr('.e', $section['classes']) }}"> <!-- boxed--emphasis -->
                    <h4>{{ parseContent($section['PRCPST01004_C2'],'title') }}</h4>
                   
                   @if(checkContent($section['PRCPST01004_C2'], 'price'))
				    	 <span class="h1">
	                    	<span class="pricing__valuta">{{ $settings['invoice_valuta'] }}</span>
	                    	{{ parseContent($section['PRCPST01004_C2'],'price') }}
	                    </span>
				    @endif
                    
                    <p>{{ parseContent($section['PRCPST01004_C2'],'text') }}</p> 
<!--                     <span class="label">Value</span> -->

					@if(checkLink($section['PRCPST01004_C2']['link']) || checkEditAcces())
		                <a class="btn btn--primary" href="{{ $section['PRCPST01004_C2']['link'] }}">
			                <span class="btn__text">
								{{ parseContent($section['PRCPST01004_C2'],'button') }}
							</span> 
						</a>
		            @endif
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="pricing pricing-1 boxed boxed--border boxed--lg e {{ parseSecAttr('.e', $section['classes']) }}"> <!-- boxed--emphasis -->
                    <h4>{{ parseContent($section['PRCPST01004_C3'],'title') }}</h4>
                    
                    @if(checkContent($section['PRCPST01004_C3'], 'price'))
				    	 <span class="h1">
	                    	<span class="pricing__valuta">{{ $settings['invoice_valuta'] }}</span>
	                    	{{ parseContent($section['PRCPST01004_C3'],'price') }}
	                    </span>
				    @endif
                    
                    <p>{{ parseContent($section['PRCPST01004_C3'],'text') }}</p> 
<!--                     <span class="label">Value</span> -->

					@if(checkLink($section['PRCPST01004_C3']['link']) || checkEditAcces())
		                <a class="btn btn--primary" href="{{ $section['PRCPST01004_C3']['link'] }}">
			                <span class="btn__text">
								{{ parseContent($section['PRCPST01004_C3'],'button') }}
							</span> 
						</a>
		            @endif
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="pricing pricing-1 boxed boxed--border boxed--lg e {{ parseSecAttr('.e', $section['classes']) }}"> <!-- boxed--emphasis -->
                    <h4>{{ parseContent($section['PRCPST01004_C4'],'title') }}</h4>
                    
                    @if(checkContent($section['PRCPST01004_C4'], 'price'))
				    	 <span class="h1">
	                    	<span class="pricing__valuta">{{ $settings['invoice_valuta'] }}</span>
	                    	{{ parseContent($section['PRCPST01004_C4'],'price') }}
	                    </span>
				    @endif
                    
                    <p>{{ parseContent($section['PRCPST01004_C4'],'text') }}</p> 
<!--                     <span class="label">Value</span> -->

					@if(checkLink($section['PRCPST01004_C4']['link']) || checkEditAcces())
		                <a class="btn btn--primary" href="{{ $section['PRCPST01004_C4']['link'] }}">
			                <span class="btn__text">
								{{ parseContent($section['PRCPST01004_C4'],'button') }}
							</span> 
						</a>
		            @endif
                </div>
            </div>
            
        </div>
        
        @if(checkContent($section['PRCPST01004_DIS'], 'text'))
        	<p>{{ parseContent($section['PRCPST01004_DIS'],'text') }}</p>
        @endif
        
    </div>
{!! constructDividers($section) !!}
</section>