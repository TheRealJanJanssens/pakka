<section id="{{ $section['id'] }}" class="cta cta-4 border--bottom {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
	<div class="container">
	    <div class="row">
	        <div class="col-md-12 d-flex justify-content-center">
		        
		        <?php
	            	$methods = \Mollie::api()->methods->all();
            	?>
		        
		        @foreach($methods as $method)
					<div class="img width-60-px m-3 {{ parseSecAttr('.img', $section['classes']) }}">
						<img src="{!! htmlspecialchars($method->image->svg) !!}" srcset="{!! htmlspecialchars($method->image->size2x) !!} 2x" alt="{!! htmlspecialchars($method->description) !!}">
					</div>
<!-- 					<b class="color--primary">{!! htmlspecialchars($method->description) !!}</b> -->
                @endforeach

		    </div>
	    </div>
	</div>
{!! constructDividers($section) !!}
</section>