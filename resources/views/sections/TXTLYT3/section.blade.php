<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
	    <h2>{{ parseContent($section['TXTLYT3_TITLE'],'title') }}</h2>
        <p class="lead mb-5">{{ parseContent($section['TXTLYT3_TITLE'],'text') }}<p>
	        
        <div class="row">
            
            <?php
	            if(isset($section['extras']['item_id'])){
					$items = App\Item::getItems($section['extras']['item_id']);
					
					
					foreach($items as $item){
						?>
						<div class="col-lg-6">
							<div class="text-block">
								@if(isset($section['extras']['item_title']))
			                    	<h5>{{ parseContent($item, $section['extras']['item_title']) }}</h5>
			                    @endif
			                    @if(isset($section['extras']['item_text']))
			                    	<p>{{ parseContent($item, $section['extras']['item_text']) }}</p>
			                    @endif
			                </div>
		                </div>
						<?php
					}   
                }else{
	                ?>
	                <div class="col-lg-6">
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLYT3_C1'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLYT3_C1'],'text') }}</p>
		                </div>
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLYT3_C2'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLYT3_C2'],'text') }}</p>
		                </div>
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLYT3_C3'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLYT3_C3'],'text') }}</p>
		                </div>
		            </div>
		            <div class="col-lg-6">
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLYT3_C4'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLYT3_C4'],'text') }}</p>
		                </div>
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLYT3_C5'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLYT3_C5'],'text') }}</p>
		                </div>
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLYT3_C6'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLYT3_C6'],'text') }}</p>
		                </div>
		            </div>
	                <?php
                }
            ?>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>