<section class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container text-center">
	    
	    @if(isset($section['IMGLIST1']['title']) || checkEditAcces())
	    	<h2>{{ parseContent($section['IMGLIST1'],'title') }}</h2>
	    @endif
	    
	    @if(isset($section['IMGLIST1']['subtitle']) || checkEditAcces())
	    	<h3>{{ parseContent($section['IMGLIST1'],'subtitle') }}</h3>
	    @endif
	    
        <div class="masonry mt-5">
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
                <?php
	                if(isset($page['item']) && isset($page['item']['images'])){
		                $item = $page['item'];
		               
		                foreach($item['images'] as $img){
							?>
							<a href="{{ imgUrl($item['id'], $img, 2500) }}" class="text-decoration-none masonry__item text-center filter-print item {{ parseSecAttr('.item', $section['classes']) }}" data-rel="lightcase:{{$item['id']}}">
			                    <div class="item-thumb">
				                    <div class="item-image img mb-3 {{ parseSecAttr('.img', $section['classes']) }}">
				                    	<img alt="Image" class="b-lazy" {{ parseImage($item, $img, 500, true) }}>
				                    </div>
			                    </div>
			                </a>
							<?php
						}
	                }else{
		                if($section['IMGLIST1']['images']){
			                foreach($section['IMGLIST1']['images'] as $img){
								?>
								<a href="{{ imgUrl($section['IMGLIST1']['id'], $img, 2500) }}" class="text-decoration-none masonry__item text-center filter-print item {{ parseSecAttr('.item', $section['classes']) }}" data-rel="lightcase:{{$section['IMGLIST1']['title']}}">
				                    <div class="item-thumb">
					                    <div class="item-image img mb-3 {{ parseSecAttr('.img', $section['classes']) }}">
					                    	<img alt="Image" class="b-lazy" {{ parseImage($section['IMGLIST1'], $img, 500, true) }}>
					                    </div>
				                    </div>
				                </a>
								<?php
							}
		                }else{
			                ?>
			                	<div class="text-decoration-none masonry__item text-center filter-print item {{ parseSecAttr('.item', $section['classes']) }}" {{ parseImage($section['IMGLIST1'], '', 500) }}>
				                    <div class="item-thumb">
					                    <div class="item-image img mb-3 {{ parseSecAttr('.img', $section['classes']) }}">
					                    	<img alt="Image" class="b-lazy" {{ parseImage($section['IMGLIST1'], '', 500, true) }}>
					                    </div>
				                    </div>
				                </div>
			                <?php
		                }
	                }
				?>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>