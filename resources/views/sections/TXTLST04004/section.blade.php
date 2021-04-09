<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3 mb-md-0">
                <div class="feature">
                    <h3>{{ parseContent($section['TXTLST04004_C1'],'title') }}</h3>
		            <p>{{ parseContent($section['TXTLST04004_C1'],'text') }}</p>
                </div>
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <div class="feature">
                    <h3>{{ parseContent($section['TXTLST04004_C2'],'title') }}</h3>
		            <p>{{ parseContent($section['TXTLST04004_C2'],'text') }}</p>
                </div>
            </div>
            <div class="col-md-3 mb-3 mb-md-0">
                <div class="feature">
                    <h3>{{ parseContent($section['TXTLST04004_C3'],'title') }}</h3>
		            <p>{{ parseContent($section['TXTLST04004_C3'],'text') }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="feature">
                    <h3>{{ parseContent($section['TXTLST04004_C4'],'title') }}</h3>
		            <p>{{ parseContent($section['TXTLST04004_C4'],'text') }}</p>
                </div>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>