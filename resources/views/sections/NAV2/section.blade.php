<div class="nav-container {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
	
	@if(empty(parseSecAttr('navigation', $section['extras'])))
		@php( $menu = DB::table('menus')->where('id', '!=', 1)->first() )	
		@php( $menuId = $menu->id)
	@else
		@php( $menuId = parseSecAttr('navigation', $section['extras']))
	@endif
		
	@php($menus = Session::get('menus'))	
	@php( $menu = $menus[$menuId] )
    <div>
        <div class="bar bar--sm visible-xs {{ parseSecAttr('.bar', $section['classes']) }}">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-3 col-md-2">
	                    <a href="/"> 
	                        @if(isset($settings['app_logo']))
				            	<img class="logo logo-dark {{ parseSecAttr('.logo', $section['classes']) }}" src="{{ config('image.app.public') }}{{ $settings['app_logo'] }}" alt="Logo {{ $settings['company_name'] }}">
				            	<img class="logo logo-light {{ parseSecAttr('.logo', $section['classes']) }}" src="{{ config('image.app.public') }}{{ $settings['app_logo'] }}" alt="Logo {{ $settings['company_name'] }}">
				            @else
				            	<img class="logo logo-dark {{ parseSecAttr('.logo', $section['classes']) }}" src="{{ config('placeholders.logo') }}" alt="Logo {{ $settings['company_name'] }}">
				            	<img class="logo logo-light {{ parseSecAttr('.logo', $section['classes']) }}" src="{{ config('placeholders.logo') }}" alt="Logo {{ $settings['company_name'] }}">
				            @endif
	                    </a>
                    </div>
                    <div class="col-9 col-md-10 text-right">
                        <a href="#" class="hamburger-toggle" data-toggle-class="#menu1;hidden-xs hidden-sm"> <i class="icon icon--sm stack-interface stack-menu"></i> </a>
                    </div>
                </div>
            </div>
        </div>
        <nav id="menu1" class="bar bar-1 hidden-xs {{ parseSecAttr('.bar', $section['classes']) }}">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-1 col-md-2 hidden-xs">
                        <div class="bar__module">
                            <a href="/"> 
	                        @if(isset($settings['app_logo']))
					            	<img class="logo logo-dark {{ parseSecAttr('.logo', $section['classes']) }}" src="{{ config('image.app.public') }}{{ $settings['app_logo'] }}" alt="Logo {{ $settings['company_name'] }}">
					            	<img class="logo logo-light {{ parseSecAttr('.logo', $section['classes']) }}" src="{{ config('image.app.public') }}{{ $settings['app_logo'] }}" alt="Logo {{ $settings['company_name'] }}">
					            @else
					            	<img class="logo logo-dark {{ parseSecAttr('.logo', $section['classes']) }}" src="{{ config('placeholders.logo') }}" alt="Logo {{ $settings['company_name'] }}">
					            	<img class="logo logo-light {{ parseSecAttr('.logo', $section['classes']) }}" src="{{ config('placeholders.logo') }}" alt="Logo {{ $settings['company_name'] }}">
					            @endif
		                    </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-10 col-md-12 text-left-sm">
                        <div class="bar__module">
                            <ul class="menu-horizontal text-left">
	                            
	                            @foreach($menu['items'] as $item)
	                            	@if(isset($item['items']))
	                            		<li class="dropdown">
		                                <span class="dropdown__trigger">{{ $item['name'] }}</span>
		                                    <div class="dropdown__container">
		                                        <div class="container">
		                                            <div class="row">
		                                                <div class="dropdown__content col-lg-3 e {{ parseSecAttr('.e', $section['classes']) }}">
		                                                    <ul class="menu-vertical">
			                                                    @foreach($item['items'] as $subitem)
		                                                        	<li> 
									                                	<a href="/{{ $subitem['link'] }}">{{ $subitem['name'] }}</a>                                	 
									                                </li>
		                                                        @endforeach
		                                                    </ul>
		                                                </div>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </li>
	                            	@else
	                            		<li> 
		                                	<a href="/{{ $item['link'] }}">{{ $item['name'] }}</a>                                	 
		                                </li>
									@endif
                                
                                @endforeach
                                
                            </ul>
                        </div>
                        
                    </div>
                    
                    <div class="col-lg-1 col-md-2 hidden-xs">
                        <div class="bar__module">
							<?php
								$smLinks = constructSocialMediaLinks();
								if(!empty($smLinks)){
									foreach($smLinks as $smLink){
										?>
										<a href="{{ $smLink['link'] }}" target="_blank" class="mr-2"> <i class="{{ $smLink['icon'] }}"></i> </a>
										<?php
									}
								}
							?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </nav>
    </div>
</div>