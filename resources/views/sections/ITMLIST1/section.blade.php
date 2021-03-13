<section class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container text-center">
	    
	    @if(isset($section['ITMLIST1']['title']) || checkEditAcces())
	    	<h2>{{ parseContent($section['ITMLIST1'],'title') }}</h2>
	    @endif
	    
	    @if(isset($section['ITMLIST1']['subtitle']) || checkEditAcces())
	    	<h3>{{ parseContent($section['ITMLIST1'],'subtitle') }}</h3>
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
	                
	                if(isset($section['extras']['item_page'])){
		                $page = $section['extras']['item_page'];
		                
		                if(!session()->has('website.'.app()->getLocale().'.'.$page)){
			                $itemPage = TheRealJanJanssens\Pakka\Models\Translation::getTranslation($page);
			                session()->put('website.'.app()->getLocale().'.'.$page, $itemPage);
		                }else{
			                $itemPage = session()->get('website.'.app()->getLocale().'.'.$page);
		                }   
	                }else{
		                $itemPage = null;
	                }
	                
					if(isset($section['extras']['item_id'])){
						
						if(!isset($section['extras']['item_limit'])){
							$section['extras']['item_limit'] = null;
						}
						
						$items = App\Item::getItems($section['extras']['item_id'],1,'desc',$section['extras']['item_limit']);

						foreach($items as $item){
							$title = "";
							$slug = $item['slug'];
							
							//makes a link or a lightcase object depending if a link page is set
							if($itemPage == null){
								$link = imgUrl($item['id'], $item['images'][0], 2500);
							}else{
								$link = '/'.$itemPage.'/'.$item['id'].'/'.$item['slug'];
							}	
							
							if(isset($item['title'])){
								$title = $item['title'];	
							}
										
							?>
							<a href="{{ $link }}" class="text-decoration-none masonry__item text-center filter-print item {{ parseSecAttr('.item', $section['classes']) }}" @if($itemPage == null) data-rel="lightcase:{{ $slug }}" @endif title="{{ $title }}"> <!-- data-masonry-filter="Print" -->
			                    <div class="item-thumb">
				                    <div class="item-image img mb-3 {{ parseSecAttr('.img', $section['classes']) }}">
				                    	<img alt="Image" class="b-lazy" {{ parseImage($item, $item['images'][0], 500, true) }}>
				                    </div>
				                    @if(isset($section['extras']['item_title']))
			                        	<h4>{{ parseContent($item, $section['extras']['item_title']) }}</h4>
			                        @endif
			                        
			                        @if(isset($section['extras']['item_text'])) 
			                        	<p class="color--dark">{{ parseContent($item, $section['extras']['item_text']) }}</p>
			                        @endif 
			                    </div>
			                </a>
			                
			                @if($itemPage == null)
			                	@php($i = 0)
	                        	@foreach($item['images'] as $image)
	                        		@php($i++)
	                        		@if($i == 1)
	                        			@continue
	                        		@endif
	                        		<a href="{{ imgUrl($item['id'], $image, 2500) }}" data-rel="lightcase:{{ $slug }}" title="{{ $title }}" class="d-none"></a>
	                        	@endforeach
	                        @endif 
							<?php
						}
					}
				?>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>