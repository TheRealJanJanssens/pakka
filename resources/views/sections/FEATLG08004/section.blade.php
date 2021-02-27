<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row">
            <div class="item {{ parseSecAttr('.item', $section['classes']) }}">
                <div class="imagebg boxed p-0 e {{ parseSecAttr('.e', $section['classes']) }}" {{ parseSecAttr('.e', $section['attributes']) }}>
                    
                    @if(!empty($section['FEATLG08004_C1']['images']) && count($section['FEATLG08004_C1']['images']) > 1)
				    	<div class="slider background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}" data-autoplay="true" data-fade="true" {{ parseSecAttr('.slider', $section['attributes']) }}>
				            @foreach($section['FEATLG08004_C1']['images'] as $image)
				                <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
									<img alt="background" {{ parseImage($section['FEATLG08004_C1'], $image, 2500) }}>
				                </div>
				            @endforeach 
				        </div>
				    @else
				    	<div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}"> 
					    	<img alt="background" {{ parseImage($section['FEATLG08004_C1'], $section['FEATLG08004_C1']['images'][0], 2500) }}> 
					    </div>
				    @endif
                    
                    <div class="pos-vertical-center col-md-12 boxed boxed--lg bg--none">
	                    @if(checkContent($section['FEATLG08004_C1'], 'title'))
					    	<h3>
						    	@if(checkContent($section['FEATLG08004_C1'], 'subtitle'))
							    	<span class="sub mb-2">{{ parseContent($section['FEATLG08004_C1'],'subtitle') }}</span>
							    @endif
						    	
						    	{{ parseContent($section['FEATLG08004_C1'],'title') }}
						    </h3>
					    @endif
					    
					    @if(checkContent($section['FEATLG08004_C1'], 'text'))
					    	<p>{{ parseContent($section['FEATLG08004_C1'],'text') }}</p>
					    @endif
					    
					    @if(checkContent($section['FEATLG08004_C1'], 'link'))
			                <a class="btn btn--primary type--uppercase mt-4 e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['FEATLG08004_C1']['link'] }}">
				                <span class="btn__text">
									{{ parseContent($section['FEATLG08004_C1'],'button') }}
								</span> 
							</a>
			            @endif
                    </div>
                </div>
            </div>
            
            <div class="item {{ parseSecAttr('.item', $section['classes']) }}">
                <div class="imagebg boxed p-0 e {{ parseSecAttr('.e', $section['classes']) }}" {{ parseSecAttr('.e', $section['attributes']) }}>
                    
                    @if(!empty($section['FEATLG08004_C2']['images']) && count($section['FEATLG08004_C2']['images']) > 1)
				    	<div class="slider background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}" data-autoplay="true" data-fade="true" {{ parseSecAttr('.slider', $section['attributes']) }}>
				            @foreach($section['FEATLG08004_C2']['images'] as $image)
				                <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
									<img alt="background" {{ parseImage($section['FEATLG08004_C2'], $image, 2500) }}>
				                </div>
				            @endforeach 
				        </div>
				    @else
				    	<div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}"> 
					    	<img alt="background" {{ parseImage($section['FEATLG08004_C2'], $section['FEATLG08004_C2']['images'][0], 2500) }}> 
					    </div>
				    @endif
                    
                    <div class="pos-vertical-center col-md-12 boxed boxed--lg bg--none">
	                    @if(checkContent($section['FEATLG08004_C2'], 'title'))
					    	<h3>
						    	@if(checkContent($section['FEATLG08004_C2'], 'subtitle'))
							    	<span class="sub mb-2">{{ parseContent($section['FEATLG08004_C2'],'subtitle') }}</span>
							    @endif
						    	
						    	{{ parseContent($section['FEATLG08004_C2'],'title') }}
						    </h3>
					    @endif
					    
					    @if(checkContent($section['FEATLG08004_C2'], 'text'))
					    	<p>{{ parseContent($section['FEATLG08004_C2'],'text') }}</p>
					    @endif
					    
					    @if(checkContent($section['FEATLG08004_C2'], 'link'))
			                <a class="btn btn--primary type--uppercase mt-4 e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['FEATLG08004_C2']['link'] }}">
				                <span class="btn__text">
									{{ parseContent($section['FEATLG08004_C2'],'button') }}
								</span> 
							</a>
			            @endif
                    </div>
                </div>
            </div>
            
            <div class="item {{ parseSecAttr('.item', $section['classes']) }}">
                <div class="imagebg boxed p-0 e {{ parseSecAttr('.e', $section['classes']) }}" {{ parseSecAttr('.e', $section['attributes']) }}>
                    
                    @if(!empty($section['FEATLG08004_C3']['images']) && count($section['FEATLG08004_C3']['images']) > 1)
				    	<div class="slider background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}" data-autoplay="true" data-fade="true" {{ parseSecAttr('.slider', $section['attributes']) }}>
				            @foreach($section['FEATLG08004_C3']['images'] as $image)
				                <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
									<img alt="background" {{ parseImage($section['FEATLG08004_C3'], $image, 2500) }}>
				                </div>
				            @endforeach 
				        </div>
				    @else
				    	<div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}"> 
					    	<img alt="background" {{ parseImage($section['FEATLG08004_C3'], $section['FEATLG08004_C3']['images'][0], 2500) }}> 
					    </div>
				    @endif
                    
                    <div class="pos-vertical-center col-md-12 boxed boxed--lg bg--none">
	                    @if(checkContent($section['FEATLG08004_C3'], 'title'))
					    	<h3>
						    	@if(checkContent($section['FEATLG08004_C3'], 'subtitle'))
							    	<span class="sub mb-2">{{ parseContent($section['FEATLG08004_C3'],'subtitle') }}</span>
							    @endif
						    	
						    	{{ parseContent($section['FEATLG08004_C3'],'title') }}
						    </h3>
					    @endif
					    
					    @if(checkContent($section['FEATLG08004_C3'], 'text'))
					    	<p>{{ parseContent($section['FEATLG08004_C3'],'text') }}</p>
					    @endif
					    
					    @if(checkContent($section['FEATLG08004_C3'], 'link'))
			                <a class="btn btn--primary type--uppercase mt-4 e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['FEATLG08004_C3']['link'] }}">
				                <span class="btn__text">
									{{ parseContent($section['FEATLG08004_C3'],'button') }}
								</span> 
							</a>
			            @endif
                    </div>
                </div>
            </div>
            
            <div class="item {{ parseSecAttr('.item', $section['classes']) }}">
                <div class="imagebg boxed p-0 e {{ parseSecAttr('.e', $section['classes']) }}" {{ parseSecAttr('.e', $section['attributes']) }}>
                    
                    @if(!empty($section['FEATLG08004_C4']['images']) && count($section['FEATLG08004_C4']['images']) > 1)
				    	<div class="slider background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}" data-autoplay="true" data-fade="true" {{ parseSecAttr('.slider', $section['attributes']) }}>
				            @foreach($section['FEATLG08004_C4']['images'] as $image)
				                <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
									<img alt="background" {{ parseImage($section['FEATLG08004_C4'], $image, 2500) }}>
				                </div>
				            @endforeach 
				        </div>
				    @else
				    	<div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}"> 
					    	<img alt="background" {{ parseImage($section['FEATLG08004_C4'], $section['FEATLG08004_C4']['images'][0], 2500) }}> 
					    </div>
				    @endif
                    
                    <div class="pos-vertical-center col-md-12 boxed boxed--lg bg--none">
	                    @if(checkContent($section['FEATLG08004_C4'], 'title'))
					    	<h3>
						    	@if(checkContent($section['FEATLG08004_C4'], 'subtitle'))
							    	<span class="sub mb-2">{{ parseContent($section['FEATLG08004_C4'],'subtitle') }}</span>
							    @endif
						    	
						    	{{ parseContent($section['FEATLG08004_C4'],'title') }}
						    </h3>
					    @endif
					    
					    @if(checkContent($section['FEATLG08004_C4'], 'text'))
					    	<p>{{ parseContent($section['FEATLG08004_C4'],'text') }}</p>
					    @endif
					    
					    @if(checkContent($section['FEATLG08004_C4'], 'link'))
			                <a class="btn btn--primary type--uppercase mt-4 e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['FEATLG08004_C4']['link'] }}">
				                <span class="btn__text">
									{{ parseContent($section['FEATLG08004_C4'],'button') }}
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