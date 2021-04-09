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
                    <div class="col-lg-11 col-md-12 text-right text-left-xs text-left-sm">
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
<!--
                                <li class="dropdown">
                                <span class="dropdown__trigger">Dropdown Slim</span>
                                    <div class="dropdown__container">
                                        <div class="container">
                                            <div class="row">
                                                <div class="dropdown__content col-lg-2">
                                                    <ul class="menu-vertical">
                                                        <li> <a href="#">Single Link</a> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                
                                <li class="dropdown">
                                <span class="dropdown__trigger">Dropdown Wide</span>
                                    <div class="dropdown__container">
                                        <div class="container">
                                            <div class="row">
                                                <div class="dropdown__content row w-100">
                                                    <div class="col-lg-3">
                                                        <h5>Menu Title</h5>
                                                        <ul class="menu-vertical">
                                                            <li> <a href="#">Single Link</a> </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <h5>Menu Title</h5>
                                                        <ul class="menu-vertical">
                                                            <li> <a href="#">Single Link</a> </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <h5>Menu Title</h5>
                                                        <ul class="menu-vertical">
                                                            <li> <a href="#">Single Link</a> </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <h5>Menu Title</h5>
                                                        <ul class="menu-vertical">
                                                            <li> <a href="#">Single Link</a> </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
-->
                                
                            </ul>
                        </div>
                        
                        @if(checkLink($section['MNAVST01001_BTN1']['link']) || checkLink($section['MNAVST01001_BTN2']['link']) || checkEditAcces())
                        
	                        <div class="bar__module">
		                        @if(checkLink($section['MNAVST01001_BTN1']['link']) || checkEditAcces())
					                <a class="btn btn--sm type--uppercase e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['MNAVST01001_BTN1']['link'] }}">
						                <span class="btn__text">
											{{ parseContent($section['MNAVST01001_BTN1'],'button') }}
										</span> 
									</a>
					            @endif
					            
					            @if(checkLink($section['MNAVST01001_BTN2']['link']) || checkEditAcces())
					                <a class="btn btn--sm btn--primary type--uppercase e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['MNAVST01001_BTN2']['link'] }}">
						                <span class="btn__text">
											{{ parseContent($section['MNAVST01001_BTN2'],'button') }}
										</span> 
									</a>
					            @endif
	                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>