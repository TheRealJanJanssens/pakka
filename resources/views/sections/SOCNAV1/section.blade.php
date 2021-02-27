<section class="p-2 {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
	<div class="container">
        <?php
			$smLinks = constructSocialMediaLinks();
			if(!empty($smLinks)){
				foreach($smLinks as $smLink){
					?>
					<a href="{{ $smLink['link'] }}" target="_blank" class="mr-2">
						<i class="{{ $smLink['icon'] }} icon icon--xs"></i>
					</a>
					<?php
				}
			}
		?>
	</div>
{!! constructDividers($section) !!}
</section>