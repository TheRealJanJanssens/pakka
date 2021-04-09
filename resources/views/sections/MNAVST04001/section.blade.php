<div class="nav-container {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>

	@if(empty($section['extras']['menu_id']))
		@php( $menu = DB::table('menus')->where('id', '!=', 1)->first() )	
		@php( $menuId = $menu->id)
	@else
		@php( $menuId = $section['extras']['menu_id'])
	@endif
	
	@php($menus = Session::get('menus'))	
	@php( $menu = $menus[$menuId] )

	@php( $menu_pieces = array_chunk($menu['items'], ceil(count($menu['items']) / 2)) )
	
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
                    <a href="#" class="hamburger-toggle" data-toggle-class="#menu2;hidden-xs "> <i class="icon icon--sm stack-interface stack-menu"></i> </a>
                </div>
            </div>
        </div>
    </div>
    <nav id="menu2" class="bar hidden-xs {{ parseSecAttr('.bar', $section['classes']) }}">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 text-center text-left-sm hidden-xs order-lg-2">
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
                <div class="col-lg-5 text-center text-lg-right order-lg-1">
                    <div class="bar__module">
                        <ul class="menu-horizontal">
                            @foreach($menu_pieces[0] as $item)
	                            
	                            <li> 
	                            	<a href="/{{ $item['link'] }}">{{ $item['name'] }}</a> 
	                            </li>
                            
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 text-center text-lg-left order-lg-3">
                    <div class="bar__module">
                        <ul class="menu-horizontal">
                            @foreach($menu_pieces[1] as $item)
	                            
	                            <li> 
	                            	<a href="/{{ $item['link'] }}">{{ $item['name'] }}</a> 
	                            </li>
                            
                            @endforeach
                            
                            @if(shopStatus())
                           		<li> 
	                            	<a href="{!! url('/'.$settings['role_cart']) !!}"><i class="fa fa-shopping-cart"></i></a> 
	                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>