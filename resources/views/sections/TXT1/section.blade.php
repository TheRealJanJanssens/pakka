<section id="{{ $section['id'] }}" class="switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-6 adaptable__text">
	            @if(checkContent($section['TXT1_C1'], 'title'))
			    	<h2>{{ parseContent($section['TXT1_C1'],'title') }}</h2>
			    @endif
			    
			    @if(checkContent($section['TXT1_C1'], 'text'))
			    	<p class="lead">{{ parseContent($section['TXT1_C1'],'text') }}</p>
			    @endif
            </div>

            <div class="col-lg-5 col-md-6">
	            @if(!empty($section['TXT1_IMG']['images']) && count($section['TXT1_IMG']['images']) > 1)
	            	<div class="slider box-shadow-realistic border--round" {{ parseSecAttr('.slider', $section['attributes']) }}>
                        @foreach($section['TXT1_IMG']['images'] as $image)
							<div class="img {{ parseSecAttr('.img', $section['classes']) }}">
								<img alt="img" {{ parseImage($section['TXT1_IMG'], $image, 500) }}>
							</div>
                        @endforeach 
                    </div>
	            @else
	            	<img alt="Image" class="img {{ parseSecAttr('.img', $section['classes']) }}" {{ parseImage($section['TXT1_IMG'], $section['TXT1_IMG']['images'][0], 500) }}>
	            @endif
	             
	        </div>
            
        </div>
    </div>
{!! constructDividers($section) !!}
</section>