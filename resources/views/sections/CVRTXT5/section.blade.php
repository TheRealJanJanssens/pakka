<section id="{{ $section['id'] }}" class="cover imagebg {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
	
	@if(!empty($section['CVRTXT5_BIMG']['images']) && count($section['CVRTXT5_BIMG']['images']) > 1)
    	<div class="slider background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}" data-autoplay="true" data-fade="true" {{ parseSecAttr('.slider', $section['attributes']) }}>
            @foreach($section['CVRTXT5_BIMG']['images'] as $image)
                <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
					<img alt="background" {{ parseImage($section['CVRTXT5_BIMG'], $image, 2500) }}>
                </div>
            @endforeach 
        </div>
    @else
    	<div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
    		<img alt="background" {{ parseImage($section['CVRTXT5_BIMG'], $section['CVRTXT5_BIMG']['images'][0], 2500) }}> 
    	</div>
    @endif
    
    <div class="container pos-vertical-center">
        <div class="row">
            <div class="col-md-9 col-lg-8">
                <h1>{{ parseContent($section['CVRTXT5_H'],'title') }}</h1>
                <p class="lead"> {{ parseContent($section['CVRTXT5_H'],'text') }} </p>
            </div>
        </div>
    </div>
    <div class="pos-absolute pos-bottom col-12">
        <div class="container">
            <div class="row">
                <div class="col-12 text-left">
                    <div class="text-block">
                        <h5>{{ parseContent($section['CVRTXT5_BIMG'],'picture_title') }}</h5>
                        <span>{{ parseContent($section['CVRTXT5_BIMG'],'picture_author') }}</span> </div>
                </div>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>