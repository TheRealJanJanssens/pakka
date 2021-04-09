<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
	    <h2>{{ parseContent($section['TXTLST03001_TITLE'],'title') }}</h2>
        <p class="lead mb-5">{{ parseContent($section['TXTLST03001_TITLE'],'text') }}<p>
	        
        <div class="row">
            
            <?php
	            if(isset($section['extras']['item_id'])){
					$items = TheRealJanJanssens\Pakka\Models\Item::getItems($section['extras']['item_id']);
					
					
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
		                    <h5>{{ parseContent($section['TXTLST03001_C1'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLST03001_C1'],'text') }}</p>
		                </div>
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLST03001_C2'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLST03001_C2'],'text') }}</p>
		                </div>
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLST03001_C3'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLST03001_C3'],'text') }}</p>
		                </div>
		            </div>
		            <div class="col-lg-6">
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLST03001_C4'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLST03001_C4'],'text') }}</p>
		                </div>
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLST03001_C5'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLST03001_C5'],'text') }}</p>
		                </div>
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLST03001_C6'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLST03001_C6'],'text') }}</p>
		                </div>
		            </div>
	                <?php
                }
            ?>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>