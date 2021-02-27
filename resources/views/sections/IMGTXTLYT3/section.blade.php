<section class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container text-center {{ parseSecAttr('.container', $section['classes']) }}">
	    
	    @if( !checkSecAttr('.container', $section['classes']) )
	    	@if(checkContent($section['IMGTXTLYT3_H'], 'title'))
		    	<h2>{{ parseContent($section['IMGTXTLYT3_H'],'title') }}</h2>
		    @endif
		    
		    @if(checkContent($section['IMGTXTLYT3_H'], 'subtitle'))
		    	<h3>{{ parseContent($section['IMGTXTLYT3_H'],'subtitle') }}</h3>
		    @endif
	    @endif
	    
        <div class="masonry {{ parseAltAttr('.container', $section['classes'],'mt-5',false) }}">
<!--
            <div class="masonry-filter-container text-center d-flex flex-wrap justify-content-center align-items-center"> <span>Category:</span>
                <div class="masonry-filter-holder">
                    <div class="masonry__filters" data-filter-all-text="All Categories">
                        <ul>
                            <li class="active" data-masonry-filter="*">All Categories</li>
                            <li data-masonry-filter="print">Print</li>
                        </ul>
                    </div>
                </div>
            </div>
-->

            <div class="row row-masonry {{ parseSecAttr('.row-masonry', $section['classes']) }}"><!-- masonry__container masonry--active -->

				<div class="text-decoration-none masonry__item text-center filter-print item col-md-4 {{ parseSecAttr('.item', $section['classes']) }}" > <!-- data-masonry-filter="Print" -->
                    <div class="item-thumb">
	                    <div class="item-image img mb-3 {{ parseSecAttr('.img', $section['classes']) }}">
	                    	<img alt="Image" class="b-lazy" {{ parseImage($section['IMGTXTLYT3_C1'], $section['IMGTXTLYT3_C1']['images'][0], 500, true) }}>
	                    </div>
	                    @if(checkContent($section['IMGTXTLYT3_C1'], 'title'))
					    	<h4>{{ parseContent($section['IMGTXTLYT3_C1'],'title') }}</h4>
					    @endif
					    
					    @if(checkContent($section['IMGTXTLYT3_C1'], 'text'))
					    	<p>{{ parseContent($section['IMGTXTLYT3_C1'],'text') }}</p>
					    @endif
                        
                        @if(checkContent($section['IMGTXTLYT3_C1'], 'link'))
			                <a class="btn btn--primary type--uppercase mt-4 e {{ parseSecAttr('.e', $section['classes']) }} {{ parseAltAttr('.container', $section['classes'],'mb-0') }}" href="{{ $section['IMGTXTLYT3_C1']['link'] }}">
				                <span class="btn__text">
									{{ parseContent($section['IMGTXTLYT3_C1'],'button') }}
								</span> 
							</a>
			            @endif
                    </div>
                </div>
                
                <div class="text-decoration-none masonry__item text-center filter-print item col-md-4 {{ parseSecAttr('.item', $section['classes']) }}" > <!-- data-masonry-filter="Print" -->
                    <div class="item-thumb">
	                    <div class="item-image img mb-3 {{ parseSecAttr('.img', $section['classes']) }}">
	                    	<img alt="Image" class="b-lazy" {{ parseImage($section['IMGTXTLYT3_C2'], $section['IMGTXTLYT3_C2']['images'][0], 500, true) }}>
	                    </div>
	                    @if(checkContent($section['IMGTXTLYT3_C2'], 'title'))
					    	<h4>{{ parseContent($section['IMGTXTLYT3_C2'],'title') }}</h4>
					    @endif
					    
					    @if(checkContent($section['IMGTXTLYT3_C2'], 'text'))
					    	<p>{{ parseContent($section['IMGTXTLYT3_C2'],'text') }}</p>
					    @endif
                        
                        @if(checkContent($section['IMGTXTLYT3_C2'], 'link'))
			                <a class="btn btn--primary type--uppercase mt-4 e {{ parseSecAttr('.e', $section['classes']) }} {{ parseAltAttr('.container', $section['classes'],'mb-0') }}" href="{{ $section['IMGTXTLYT3_C2']['link'] }}">
				                <span class="btn__text">
									{{ parseContent($section['IMGTXTLYT3_C2'],'button') }}
								</span> 
							</a>
			            @endif
                    </div>
                </div>
                
                <div class="text-decoration-none masonry__item text-center filter-print item col-md-4 {{ parseSecAttr('.item', $section['classes']) }}" > <!-- data-masonry-filter="Print" -->
                    <div class="item-thumb">
	                    <div class="item-image img mb-3 {{ parseSecAttr('.img', $section['classes']) }}">
	                    	<img alt="Image" class="b-lazy" {{ parseImage($section['IMGTXTLYT3_C3'], $section['IMGTXTLYT3_C3']['images'][0], 500, true) }}>
	                    </div>
	                    @if(checkContent($section['IMGTXTLYT3_C3'], 'title'))
					    	<h4>{{ parseContent($section['IMGTXTLYT3_C3'],'title') }}</h4>
					    @endif
					    
					    @if(checkContent($section['IMGTXTLYT3_C3'], 'text'))
					    	<p>{{ parseContent($section['IMGTXTLYT3_C3'],'text') }}</p>
					    @endif
                        
                        @if(checkContent($section['IMGTXTLYT3_C3'], 'link'))
			                <a class="btn btn--primary type--uppercase mt-4 e {{ parseSecAttr('.e', $section['classes']) }} {{ parseAltAttr('.container', $section['classes'],'mb-0') }}" href="{{ $section['IMGTXTLYT3_C3']['link'] }}">
				                <span class="btn__text">
									{{ parseContent($section['IMGTXTLYT3_C3'],'button') }}
								</span> 
							</a>
			            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>