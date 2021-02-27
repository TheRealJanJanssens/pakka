<section class="p-2 switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
	<div class="container">
		<div class="row">
			<div class="text-center text-md-right m-0 col-md-6">
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
			
			<div class="text-center text-md-left m-0 col-md-6">
		        <p>
			        @if(isset($settings['company_phone']))
				        <a href="tel:{{ $settings['company_phone'] }}" class="type--nodeco"><i class="fa fa-phone mx-2"></i>{{ $settings['company_phone'] }}</a>
			        @endif
			        
			        @if(isset($settings['company_email']))
				        <a href="mailto:{{ $settings['company_email'] }}" class="type--nodeco"><i class="fa fa-envelope mx-2"></i>{{ $settings['company_email'] }}</a>
			        @endif
			    </p>
			</div>
		</div>
	</div>
{!! constructDividers($section) !!}
</section>