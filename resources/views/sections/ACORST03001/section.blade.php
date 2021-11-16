<section class="switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-6 adaptable__text">
                <ul class="accordion {{ parseSecAttr('.accordion', $section['classes']) }}">
                    @if(checkContent($section['ACORST03001_C1'], 'text'))
                        <li class="active">
                            <div class="accordion__title"> <span class="h5">{{ parseContent($section['ACORST03001_C1'],'title') }}</span> </div>
                            <div class="accordion__content">
                                <p class="lead">{{ parseContent($section['ACORST03001_C1'],'text') }}</p>
                            </div>
                        </li>
                    @endif

                    @if(checkContent($section['ACORST03001_C2'], 'text'))
                        <li>
                            <div class="accordion__title"> <span class="h5">{{ parseContent($section['ACORST03001_C2'],'title') }}</span> </div>
                            <div class="accordion__content">
                                <p class="lead">{{ parseContent($section['ACORST03001_C2'],'text') }}</p>
                            </div>
                        </li>
                    @endif

                    @if(checkContent($section['ACORST03001_C3'], 'text'))
                        <li>
                            <div class="accordion__title"> <span class="h5">{{ parseContent($section['ACORST03001_C3'],'title') }}</span> </div>
                            <div class="accordion__content">
                                <p class="lead">{{ parseContent($section['ACORST03001_C3'],'text') }}</p>
                            </div>
                        </li>
                    @endif

                    @if(checkContent($section['ACORST03001_C4'], 'text'))
                        <li>
                            <div class="accordion__title"> <span class="h5">{{ parseContent($section['ACORST03001_C4'],'title') }}</span> </div>
                            <div class="accordion__content">
                                <p class="lead">{{ parseContent($section['ACORST03001_C4'],'text') }}</p>
                            </div>
                        </li>
                    @endif

                    @if(checkContent($section['ACORST03001_C5'], 'text'))
                        <li>
                            <div class="accordion__title"> <span class="h5">{{ parseContent($section['ACORST03001_C5'],'title') }}</span> </div>
                            <div class="accordion__content">
                                <p class="lead">{{ parseContent($section['ACORST03001_C5'],'text') }}</p>
                            </div>
                        </li>
                    @endif

                    @if(checkContent($section['ACORST03001_C6'], 'text'))
                        <li>
                            <div class="accordion__title"> <span class="h5">{{ parseContent($section['ACORST03001_C6'],'title') }}</span> </div>
                            <div class="accordion__content">
                                <p class="lead">{{ parseContent($section['ACORST03001_C6'],'text') }}</p>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="col-lg-5 col-md-6">
	            @if(!empty($section['ACORST03001_IMG']['images']) && count($section['ACORST03001_IMG']['images']) > 1)
	            	<div class="slider box-shadow-realistic border--round" {{ parseSecAttr('.slider', $section['attributes']) }}>
                        @foreach($section['ACORST03001_IMG']['images'] as $image)
							<div class="img {{ parseSecAttr('.img', $section['classes']) }}">
								<img alt="img" {{ parseImage($section['ACORST03001_IMG'], $image, 500) }}>
							</div>
                        @endforeach 
                    </div>
	            @else
	            	<img alt="Image" class="img {{ parseSecAttr('.img', $section['classes']) }}" {{ parseImage($section['ACORST03001_IMG'], $section['ACORST03001_IMG']['images'][0], 500) }}>
	            @endif
	             
	        </div>
            
        </div>
    </div>
{!! constructDividers($section) !!}
</section>