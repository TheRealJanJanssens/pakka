<section id="{{ $section['id'] }}" class="switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12 col-md-3 adaptable__text">
	            <h2>{{ parseContent($section['IFRMST01003_C1'],'title') }}</h2>
	            
	            {!! html_entity_decode($section['IFRMST01003_C1']['iframe']) !!}
            </div>

            <div class="col-12 col-md-3 adaptable__text">
	            <h2>{{ parseContent($section['IFRMST01003_C2'],'title') }}</h2>
	            
	            {!! html_entity_decode($section['IFRMST01003_C2']['iframe']) !!}
            </div>

            <div class="col-12 col-md-3 adaptable__text">
	            <h2>{{ parseContent($section['IFRMST01003_C3'],'title') }}</h2>
	            
	            {!! html_entity_decode($section['IFRMST01003_C3']['iframe']) !!}
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>