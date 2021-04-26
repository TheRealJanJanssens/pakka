<section id="{{ $section['id'] }}" class="switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-between {{ parseSecAttr('.row', $section['classes']) }}">

			<div class="process-1">
				@php($count = 11)
				@for ($i = 1; $i < $count; $i++)
					@if(checkContent($section['TMLNST01001_C'.$i], 'title'))
						<div class="process__item">
							@if(checkContent($section['TMLNST01001_C'.$i], 'title'))
								<h4>{{ parseContent($section['TMLNST01001_C'.$i],'title') }}</h4>
							@endif
							
							@if(checkContent($section['TMLNST01001_C'.$i], 'text'))
								<p>{{ parseContent($section['TMLNST01001_C'.$i],'text') }}</p>
							@endif
						</div>
					@endif
				@endfor
			</div>
            
        </div>
    </div>
{!! constructDividers($section) !!}
</section>