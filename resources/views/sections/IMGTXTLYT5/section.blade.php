<section class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container text-center">
	    
	    @if( !checkSecAttr('.container', $section['classes']) )
		    @if(checkContent($section['IMGTXTLYT5_H'], 'title'))
		    	<h2>{{ parseContent($section['IMGTXTLYT5_H'],'title') }}</h2>
		    @endif
		    
		    @if(checkContent($section['IMGTXTLYT5_H'], 'subtitle'))
		    	<h3>{{ parseContent($section['IMGTXTLYT5_H'],'subtitle') }}</h3>
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

				<div class="text-decoration-none masonry__item text-center filter-print item col-12 {{ parseSecAttr('.item', $section['classes']) }}" > <!-- data-masonry-filter="Print" -->
                    <a href="{{ $section['IMGTXTLYT5_C1']['link'] }}" class="item-thumb link e {{ parseSecAttr('.e', $section['classes']) }}">
	                    <div class="item-image img mb-3 {{ parseSecAttr('.img', $section['classes']) }}">
	                    	<img alt="Image" class="b-lazy" {{ parseImage($section['IMGTXTLYT5_C1'], $section['IMGTXTLYT5_C1']['images'][0], 500, true) }}>
	                    </div>
	                    @if(isset($section['IMGTXTLYT5_C1']['title']) || checkEditAcces())
					    	<h4>{{ parseContent($section['IMGTXTLYT5_C1'],'title') }}</h4>
					    @endif
					    
					    @if(isset($section['IMGTXTLYT5_C1']['text']) || checkEditAcces())
					    	<p>{{ parseContent($section['IMGTXTLYT5_C1'],'text') }}</p>
					    @endif
                    </a>
                </div>
							
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>