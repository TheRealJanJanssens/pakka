<section id="{{ $section['id'] }}" class="text-center-xs {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row">
	        
	        <?php
		        //social media links
			    $smLinks = constructSocialMediaLinks();
	        ?>
	        
            <div class="col-sm-7">
	            
	            @if(empty($section['extras']['menu_id']))
					@php( $menu = DB::table('menus')->where('id', '!=', 1)->first() )	
					@php( $menuId = $menu->id)
				@else
					@php( $menuId = $section['extras']['menu_id'])
				@endif
				
				@php($menus = Session::get('menus'))	
				@php( $menu = $menus[$menuId] )
                
                <ul class="list-inline">
                    @foreach($menu['items'] as $item)
                            
                        <li> 
                        	<a href="{{ $item['link'] }}">
	                        	<span class="h6 type--uppercase">{{ $item['name'] }}</span>
	                        </a> 
                        </li>
                    
                    @endforeach
                </ul>
                
            </div>
            <div class="col-sm-5 text-right text-center-xs">
	            <ul class="social-list list-inline list--hover">
	            @if(!empty($smLinks))
					@foreach($smLinks as $smLink)
						<li>
							<a href="{{ $smLink['link'] }}" target="_blank" class="mr-2">
								<i class="{{ $smLink['icon'] }} icon icon--xs"></i>
							</a>
						</li>
					@endforeach
				@endif
				</ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7"> 
	            <span class="type--fine-print">
	            	<a href="http://www.pakka.be">Made by Päkka</a> © <span class="update-year"></span> {{ $settings['company_name'] }}
	            </span>
	            
	            @if(empty($section['extras']['submenu_id']))
					@php( $menu = DB::table('menus')->where('id', '!=', 1)->first() )	
					@php( $menuId = $menu->id)
				@else
					@php( $menuId = $section['extras']['submenu_id'])
				@endif
				
				@php($menus = Session::get('menus'))	
				@php( $menu = $menus[$menuId] )
            	
                @foreach($menu['items'] as $item)
                    <a href="{{ $item['link'] }}" class="type--fine-print">{{ $item['name'] }}</a>
                @endforeach
	        </div>
            
            <div class="col-sm-5 text-right text-center-xs"> 
	            <a class="type--fine-print" href="mailto:{{ $settings['company_email'] }}">{{ $settings['company_email'] }}</a> 
	        </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>