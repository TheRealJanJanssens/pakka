<section id="{{ $section['id'] }}" class="cover imagebg {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
	
	 @if(!empty($section['HEROIG01001_BIMG']['images']) && count($section['HEROIG01001_BIMG']['images']) > 1)
    	<div class="slider background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}" data-autoplay="true" data-fade="true" {{ parseSecAttr('.slider', $section['attributes']) }}>
            @foreach($section['HEROIG01001_BIMG']['images'] as $image)
                <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
					<img alt="background" {{ parseImage($section['HEROIG01001_BIMG'], $image, 2500) }}>
                </div>
            @endforeach 
        </div>
    @else
    	<div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
    		<img alt="background" {{ parseImage($section['HEROIG01001_BIMG'], $section['HEROIG01001_BIMG']['images'][0], 2500) }}> 
    	</div>
    @endif
    
    <div class="container pos-vertical-center">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ parseContent($section['HEROIG01001_H'],'title') }}</h1>
                <p class="lead">{{ parseContent($section['HEROIG01001_H'],'text') }}</p>
                
                @if(checkContent($section['HEROIG01001_H'], 'link'))
	                <a class="btn btn--primary type--uppercase e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['HEROIG01001_H']['link'] }}">
		                <span class="btn__text">
							{{ parseContent($section['HEROIG01001_H'],'button') }}
						</span> 
					</a>
	            @endif
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>