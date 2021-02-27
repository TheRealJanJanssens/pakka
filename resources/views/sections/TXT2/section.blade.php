<section id="{{ $section['id'] }}" class="switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12 adaptable__text">
	            <?php
		            if(isset($section['extras']['item_title']) && isset($page['item'])){
			            ?>
			           	<h2>{{ parseContent($page['item'],$section['extras']['item_title']) }}</h2>
			            <?php
		            }else{
			            ?>
			           	<h2>{{ parseContent($section['TXT2_C1'],'title') }}</h2>
			            <?php
		            }
	            ?>
	            
	            <?php
		            if(isset($section['extras']['item_text']) && isset($page['item'])){
			            ?>
			           	<p class="lead">{{ parseContent($page['item'],$section['extras']['item_text']) }}<p>
			            <?php
		            }else{
			            ?>
			           	<p class="lead">{{ parseContent($section['TXT2_C1'],'text') }}<p>
			            <?php
		            }
	            ?>
            </div>
        </div>
    </div>
    
<!--
    <div class="divider">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1198 30" class="top">
          <path d="M-1,30C-1,30,599,30,599,30C599,30,599,19.33,599,0C453.66,0,374.09,14.24,199.67,22.97C89.21,28.49,-1,30,-1,30C-1,30,-1,30,-1,30M1199,30C1199,30,599,30,599,30C599,30,599,19.33,599,0C744.34,0,823.91,14.24,998.33,22.97C1108.79,28.49,1199,30,1199,30C1199,30,1199,30,1199,30"></path>
        </svg>
    </div>
-->
{!! constructDividers($section) !!}
</section>