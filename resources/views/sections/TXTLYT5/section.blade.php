<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-3 mb-md-0">
                <h3>{{ parseContent($section['TXTLYT5_C1'],'title') }}</h3>
	            <p>{{ parseContent($section['TXTLYT5_C1'],'text') }}</p>
            </div>
            <div class="col-md-6">
                <h3>{{ parseContent($section['TXTLYT5_C2'],'title') }}</h3>
	            <p>{{ parseContent($section['TXTLYT5_C2'],'text') }}</p>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>