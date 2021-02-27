<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="feature">
                    <h3>{{ parseContent($section['TXTLYT6_C1'],'title') }}</h3>
		            <p>{{ parseContent($section['TXTLYT6_C1'],'text') }}</p>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="feature">
                    <h3>{{ parseContent($section['TXTLYT6_C2'],'title') }}</h3>
		            <p>{{ parseContent($section['TXTLYT6_C2'],'text') }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature">
                    <h3>{{ parseContent($section['TXTLYT6_C3'],'title') }}</h3>
		            <p>{{ parseContent($section['TXTLYT6_C3'],'text') }}</p>
                </div>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>