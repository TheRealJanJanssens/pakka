<section id="{{ $section['id'] }}" class="cta cta-4 border--bottom {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
	<div class="container">
	    <div class="row">
	        <div class="col-md-12">
		        @if(checkContent($section['CTAH5_H'], 'label'))
		        	<span class="label label--inline">{{ parseContent($section['CTAH5_H'],'label') }}</span>
		        @endif
		        <span>{{ parseContent($section['CTAH5_H'],'text') }}</span>
		    </div>
	    </div>
	</div>
{!! constructDividers($section) !!}
</section>