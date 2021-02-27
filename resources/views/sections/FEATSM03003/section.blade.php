<section class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
	    <div class="row">
		    <div class="col-12">
			    @if(checkContent($section['FEATSM03003_H'], 'title'))
			    	<h2>{{ parseContent($section['FEATSM03003_H'],'title') }}</h2>
			    @endif
			    
			    @if(checkContent($section['FEATSM03003_H'], 'subtitle'))
			    	<h3>{{ parseContent($section['FEATSM03003_H'],'subtitle') }}</h3>
			    @endif
		    </div>
	    </div>
	    
        <div class="row">
            <div class="col-md-4">
                <div class="feature boxed e {{ parseSecAttr('.e', $section['classes']) }}">
                    <div class="feature__body">
	                    @if(checkContent($section['FEATSM03003_C1'], 'icon'))
					    	<i class="h3">{{ parseContent($section['FEATSM03003_C1'],'icon') }}</i>
					    @endif
	                    
                        @if(checkContent($section['FEATSM03003_C1'], 'title'))
					    	<h4>{{ parseContent($section['FEATSM03003_C1'],'title') }}</h4>
					    @endif
					    
					    @if(checkContent($section['FEATSM03003_C1'], 'text'))
					    	<p>{{ parseContent($section['FEATSM03003_C1'],'text') }}</p>
					    @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature boxed e {{ parseSecAttr('.e', $section['classes']) }}"> 
                    <div class="feature__body">
	                    @if(checkContent($section['FEATSM03003_C2'], 'icon'))
					    	<i class="h3">{{ parseContent($section['FEATSM03003_C2'],'icon') }}</i>
					    @endif
	                    
                        @if(checkContent($section['FEATSM03003_C2'], 'title'))
					    	<h4>{{ parseContent($section['FEATSM03003_C2'],'title') }}</h4>
					    @endif
					    
					    @if(checkContent($section['FEATSM03003_C2'], 'text'))
					    	<p>{{ parseContent($section['FEATSM03003_C2'],'text') }}</p>
					    @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature boxed e {{ parseSecAttr('.e', $section['classes']) }}"> 
                    <div class="feature__body">
	                    @if(checkContent($section['FEATSM03003_C3'], 'icon'))
					    	<i class="h3">{{ parseContent($section['FEATSM03003_C3'],'icon') }}</i>
					    @endif
	                    
                        @if(checkContent($section['FEATSM03003_C3'], 'title'))
					    	<h4>{{ parseContent($section['FEATSM03003_C3'],'title') }}</h4>
					    @endif
					    
					    @if(checkContent($section['FEATSM03003_C3'], 'text'))
					    	<p>{{ parseContent($section['FEATSM03003_C3'],'text') }}</p>
					    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>