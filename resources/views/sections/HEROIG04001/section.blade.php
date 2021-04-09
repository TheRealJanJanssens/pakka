<section id="{{ $section['id'] }}" class="imageblock switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="imageblock__content col-lg-6 col-md-4 pos-right">
        @if(!empty($section['HEROIG04001_BIMG']['images']) && count($section['HEROIG04001_BIMG']['images']) > 1)
        	<div class="slider background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}" data-autoplay="true" data-fade="true" {{ parseSecAttr('.slider', $section['attributes']) }}>
                @foreach($section['HEROIG04001_BIMG']['images'] as $image)
	                <div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
						<img alt="background" {{ parseImage($section['HEROIG04001_BIMG'], $image, 2500) }}>
	                </div>
                @endforeach 
            </div>
        @else
        	<div class="background-image-holder {{ parseSecAttr('.background-image-holder', $section['classes']) }}">
        		<img alt="background" {{ parseImage($section['HEROIG04001_BIMG'], $section['HEROIG04001_BIMG']['images'][0], 2500) }}> 
        	</div>
        @endif

        @if (isset($section['extras']['divider_shape_side']))
            <?php 
                $orientation = isset($section['extras']['divider_shape_side']) ? "divider-side" : "";
                $shape = isset($section['extras']['divider_shape_side']) ? $section['extras']['divider_shape_side'] : "";
                $classes = isset($section['classes']['.divider-side']) ? $section['classes']['.divider-side'] : "";
                $classes = "$orientation $classes";
                echo view('pakka::partials.dividers.'.$shape, ['classes' => $classes]);
            ?>
        @endif

    </div>

    <div class="container pos-vertical-center">
        <div class="row--e {{ parseSecAttr('.row--e', $section['classes']) }}">
            <div class="col-lg-5 col-md-7">
                <h1>{{ parseContent($section['HEROIG04001_H'],'title') }}</h1>
                <p class="lead">{{ parseContent($section['HEROIG04001_H'],'text') }}</p>
                
                @if(checkContent($section['HEROIG04001_H'], 'link'))
	                <a class="btn btn--primary type--uppercase e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['HEROIG04001_H']['link'] }}">
		                <span class="btn__text">
							{{ parseContent($section['HEROIG04001_H'],'button') }}
						</span> 
					</a>
	            @endif
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>