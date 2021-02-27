<footer class="text-center {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="heading-block">
                    <ul class="list-inline list--hover">
	                    
	                    @if(empty($section['extras']['menu_id']))
							@php( $menu = \App\Menu::getMenuOrFirst(null) )
						@else
							@php( $menu = \App\Menu::getMenuOrFirst($section['extras']['menu_id']) )
						@endif

	                    @foreach($menu['items'] as $item)
	                            
                        <li> 
                        	<a href="{{ $item['link'] }}">{{ $item['name'] }}</a> 
                        </li>
                        
                        @endforeach
                    </ul>
                </div>
                <div>
                    <ul class="social-list list-inline list--hover">
	                    <?php
							$smLinks = constructSocialMediaLinks();
							if(!empty($smLinks)){
								foreach($smLinks as $smLink){
									?>
									<li><a href="{{ $smLink['link'] }}" target="_blank" class="mr-2"> <i class="{{ $smLink['icon'] }} icon icon--xs"></i> </a></li>
									<?php
								}
							}
						?>
                    </ul>
                </div>
                
                <div> 
	                <span class="type--fine-print mx-2">
	                	© <span class="update-year"></span> {{ $settings['company_name'] }}</span> 
						
						@if(empty($section['extras']['credmenu_id']))
							@php( $menu = \App\Menu::getMenuOrFirst(null) )
						@else
							@php( $menu = \App\Menu::getMenuOrFirst($section['extras']['credmenu_id']) )
						@endif
	                	
	                	@foreach($menu['items'] as $item)

                        	<a class="type--fine-print mx-2" href="{{ $item['link'] }}">{{ $item['name'] }}</a> 
                        
                        @endforeach
	            </div>
	            
	            <div> 
	                <a href="http://www.pakka.be" class="type--fine-print">Gemaakt met <i class="fa fa-heart color--pink"></i> door Päkka</a>
	          	</div>
            </div>
        </div>
    </div>
</footer>