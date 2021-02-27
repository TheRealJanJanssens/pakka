<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
	    
	    @if(isset($section['PRCPLN3_HEAD']['title']) || checkEditAcces())
	    	<h2>{{ parseContent($section['PRCPLN3_HEAD'],'title') }}</h2>
	    @endif
	    
        <div class="row">
	        
            <div class="col-md-4">
                <div class="pricing pricing-1 boxed boxed--lg e {{ parseSecAttr('.e', $section['classes']) }}"> <!-- boxed--emphasis -->
                    <h4>{{ parseContent($section['PRCPLN3_C1'],'title') }}</h4>
                    
                    @if(checkContent($section['PRCPLN3_C1'], 'price'))
				    	 <span class="h1">
	                    	<span class="pricing__valuta">{{ $settings['invoice_valuta'] }}</span>
	                    	{{ parseContent($section['PRCPLN3_C1'],'price') }}
	                    </span>
				    @endif
                    
                    <p>{{ parseContent($section['PRCPLN3_C1'],'text') }}</p> 
<!--                     <span class="label">Value</span> -->

					@if(checkContent($section['PRCPLN3_C1'], 'link'))
		                <a class="btn btn--primary"  href="{{ $section['PRCPLN3_C1']['link'] }}">
			                <span class="btn__text">
								{{ parseContent($section['PRCPLN3_C1'],'button') }}
							</span> 
						</a>
		            @endif
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="pricing pricing-1 boxed boxed--lg e {{ parseSecAttr('.e', $section['classes']) }}"> <!-- boxed--emphasis -->
                    <h4>{{ parseContent($section['PRCPLN3_C2'],'title') }}</h4>
                    
                    @if(checkContent($section['PRCPLN3_C2'], 'price'))
				    	 <span class="h1">
	                    	<span class="pricing__valuta">{{ $settings['invoice_valuta'] }}</span>
	                    	{{ parseContent($section['PRCPLN3_C2'],'price') }}
	                    </span>
				    @endif
                    
                    <p>{{ parseContent($section['PRCPLN3_C2'],'text') }}</p> 
<!--                     <span class="label">Value</span> -->

					@if(checkContent($section['PRCPLN3_C2'], 'link'))
		                <a class="btn btn--primary" href="{{ $section['PRCPLN3_C2']['link'] }}">
			                <span class="btn__text">
								{{ parseContent($section['PRCPLN3_C2'],'button') }}
							</span> 
						</a>
		            @endif
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="pricing pricing-1 boxed boxed--lg e {{ parseSecAttr('.e', $section['classes']) }}"> <!-- boxed--emphasis -->
                    <h4>{{ parseContent($section['PRCPLN3_C3'],'title') }}</h4>
                    
                    @if(checkContent($section['PRCPLN3_C3'], 'price'))
				    	 <span class="h1">
	                    	<span class="pricing__valuta">{{ $settings['invoice_valuta'] }}</span>
	                    	{{ parseContent($section['PRCPLN3_C3'],'price') }}
	                    </span>
				    @endif
                    
                    <p>{{ parseContent($section['PRCPLN3_C3'],'text') }}</p> 
<!--                     <span class="label">Value</span> -->

					@if(checkContent($section['PRCPLN3_C3'], 'link'))
		                <a class="btn btn--primary" href="{{ $section['PRCPLN3_C3']['link'] }}">
			                <span class="btn__text">
								{{ parseContent($section['PRCPLN3_C3'],'button') }}
							</span> 
						</a>
		            @endif
                </div>
            </div>
            
        </div>
        
        @if(checkContent($section['PRCPLN3_DIS'], 'text'))
        	<p>{{ parseContent($section['PRCPLN3_DIS'],'text') }}</p>
        @endif
        
    </div>
{!! constructDividers($section) !!}
</section>