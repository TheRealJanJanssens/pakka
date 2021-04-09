<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="text-block">
                    <h4>{{ parseContent($section['TXTLST02001_TITLE'],'title') }}</h4>
                    <p class="lead">{{ parseContent($section['TXTLST02001_TITLE'],'text') }}<p>
                </div>
            </div>
            
            <?php
	            if(isset($section['extras']['item_id'])){
					$items = App\Item::getItems($section['extras']['item_id']);
					$itemsCount = count($items)/2;
					$i = 1;
					
					echo '<div class="col-lg-4">';
					foreach($items as $item){
						?>
						<div class="text-block">
							@if(isset($section['extras']['item_title']))
		                    	<h5>{{ parseContent($item, $section['extras']['item_title']) }}</h5>
		                    @endif
		                    @if(isset($section['extras']['item_text']))
		                    	<p>{{ parseContent($item, $section['extras']['item_text']) }}</p>
		                    @endif
		                </div>
						<?php
						
						if(round($itemsCount) == $i){
							echo '</div><div class="col-lg-4">';
						}
						
						if($itemsCount == $i){
							echo '</div>';
						}
						$i++;
					}    
                }else{
	                ?>
	                <div class="col-lg-4">
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLST02001_C1'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLST02001_C1'],'text') }}</p>
		                </div>
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLST02001_C2'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLST02001_C2'],'text') }}</p>
		                </div>
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLST02001_C3'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLST02001_C3'],'text') }}</p>
		                </div>
		            </div>
		            <div class="col-lg-4">
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLST02001_C4'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLST02001_C4'],'text') }}</p>
		                </div>
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLST02001_C5'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLST02001_C5'],'text') }}</p>
		                </div>
		                <div class="text-block">
		                    <h5>{{ parseContent($section['TXTLST02001_C6'],'title') }}</h5>
		                    <p>{{ parseContent($section['TXTLST02001_C6'],'text') }}</p>
		                </div>
		            </div>
	                <?php
                }
            ?>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>