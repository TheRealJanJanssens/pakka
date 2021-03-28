<div class="social-banner {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
	<div class="container--full-width">
		<div class="row">
			<div class="col-12">
				<div class="row no-gutters">
					
					<?php
						//if no info isset in session get the info through api
						if (session()->exists('instagram_response')) {
							$info = session()->get('instagram_response');
						}else{
							$info = getIGInfo();
							session()->put('instagram_response', $info);
						}
						
						$i = 0;
						$max = 5;
						
						if(is_array($info)){
							foreach($info['media'] as $item){
								
								if($i == $max){
									break;
								}
								
								$class = "";
								if($i == 4){
									$class="d-none d-lg-block ";
								}
								
								?>
								<div class="{{ $class }}col-6 col-md-3 col-lg">
									<a href="{{ $settings['social_instagram'] }}" target="_blank">
										<div class="social-banner-img transistion" style="background-image: url({{ $item['node']['display_url'] }})"></div>
									</a>
								</div>
								<?php
								$i++;
							}
						}else{
							if(!empty($section['IGBAN1_IMG']['images'])){
								foreach($section['IGBAN1_IMG']['images'] as $image){
									
									if($i == $max){
										break;
									}
									
									$class = "";
									if($i == 4){
										$class="d-none d-lg-block ";
									}
									
									?>
									<div class="{{ $class }}col-6 col-md-3 col-lg">
										<a href="{{ $settings['social_instagram'] }}" target="_blank">
											<div class="social-banner-img transistion" style="background-image: url({{ $image }})"></div>
										</a>
									</div>
									<?php
									$i++;
								}
							}
/*
							else{
								for($x = 0; $x <= 4; $x++){
								?>
									<div class="col-6 col-md-3 col-lg">
										<div class="social-banner-img transistion" style="background-image: url(/public/vendor/images/placeholders/image.jpg)" {{ parseImage($section['IGBAN1_IMG'], "", 500) }}></div>
									</div>
								<?php
								}
							}
*/
						}
					?>
				</div>
			
				@if(is_array($info))
					<a href="{{ $settings['social_instagram'] }}" target="_blank" class="absolute-fill">
						<div class="social-banner-info transistion d-flex flex-column justify-content-center align-items-center absolute-fill">
							<i class="fa fa-instagram icon icon--md"></i>
							<h2 class="mb-2">Instagram</h2>
							<p>@ {{ $info['username'] }}</p>
						</div>
					</a>
				@endif
			</div>
		</div>
	</div>
</div>