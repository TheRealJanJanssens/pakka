<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>{{ parseContent($section['TXTLYT4_C1'],'title') }}</h3>
	            <p>{{ parseContent($section['TXTLYT4_C1'],'text') }}</p>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>