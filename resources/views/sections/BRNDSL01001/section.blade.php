<section class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
	    <div class="row">
		    @if(checkContent($section['BRNDSL01001_C1'], 'title'))
	            <div class="col-12">
		            @if(checkContent($section['BRNDSL01001_C1'], 'title'))
				    	<h2>{{ parseContent($section['BRNDSL01001_C1'],'title') }}</h2>
				    @endif
				    @if(checkContent($section['BRNDSL01001_C1'], 'title'))
				    	<p class="lead mb-5">{{ parseContent($section['BRNDSL01001_C1'],'text') }}</p>
				    @endif
	            </div>
            @endif

            <div class="col-12">
	            @if(!empty($section['BRNDSL01001_IMG']['images']) && count($section['BRNDSL01001_IMG']['images']) > 1)
	            	<div class="slider" {{ parseSecAttr('.slider', $section['attributes']) }}>
                        @foreach($section['BRNDSL01001_IMG']['images'] as $image)
							<div class="img {{ parseSecAttr('.img', $section['classes']) }}">
								<img alt="img" {{ parseImage($section['BRNDSL01001_IMG'], $image, 500) }}>
							</div>
                        @endforeach 
                    </div>
	            @else
	            	<div class="row justify-content-md-center">
		            	<div class="col-md-4">
	            			<img alt="Image" class="img {{ parseSecAttr('.img', $section['classes']) }}" {{ parseImage($section['BRNDSL01001_IMG'], $section['BRNDSL01001_IMG']['images'][0], 500) }}>
		            	</div>
	            	</div>
	            @endif
	        </div>
            
        </div>
    </div>    
    <!--end of container-->
{!! constructDividers($section) !!}
</section>