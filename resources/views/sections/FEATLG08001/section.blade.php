<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="imagebg boxed p-0 mb-0 e {{ parseSecAttr('.e', $section['classes']) }}" {{ parseSecAttr('.e', $section['attributes']) }}>
                    
                    @if(!empty($section['FEATLG08001_BIMG']['images']) && count($section['FEATLG08001_BIMG']['images']) > 1)
				    	<div class="slider background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}" data-autoplay="true" data-fade="true" {{ parseSecAttr('.slider', $section['attributes']) }}>
				            @foreach($section['FEATLG08001_BIMG']['images'] as $image)
				                <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
									<img alt="background" {{ parseImage($section['FEATLG08001_BIMG'], $image, 2500) }}>
				                </div>
				            @endforeach 
				        </div>
				    @else
				    	<div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}"> 
					    	<img alt="background" {{ parseImage($section['FEATLG08001_BIMG'], $section['FEATLG08001_BIMG']['images'][0], 2500) }}> 
					    </div>
				    @endif
                    
                    <div class="pos-vertical-center col-md-6 boxed boxed--lg bg--none">
	                    @if(checkContent($section['FEATLG08001_H'], 'title'))
					    	<h2>
						    	@if(checkContent($section['FEATLG08001_H'], 'subtitle'))
							    	<span class="sub mb-2">{{ parseContent($section['FEATLG08001_H'],'subtitle') }}</span>
							    @endif
						    	
						    	{{ parseContent($section['FEATLG08001_H'],'title') }}
						    </h2>
					    @endif
					    
					    @if(checkContent($section['FEATLG08001_H'], 'text'))
					    	<p class="lead">{{ parseContent($section['FEATLG08001_H'],'text') }}</p>
					    @endif
					    
					    @if(checkContent($section['FEATLG08001_H'], 'link'))
			                <a class="btn btn--primary type--uppercase mt-4 e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['FEATLG08001_H']['link'] }}">
				                <span class="btn__text">
									{{ parseContent($section['FEATLG08001_H'],'button') }}
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