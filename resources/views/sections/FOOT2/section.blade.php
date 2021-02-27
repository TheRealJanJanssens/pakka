<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-xs-6">
	                <?php
		            
			            $settings = Session::get('settings');
			            
		            ?>
	                
                    <h6 class="type--uppercase">{{ $settings['company_name'] }}</h6>
                    <ul class="list--hover">
                        <p>{{ $settings['company_address'] }}<br>{{ $settings['company_city'] }}<br>{{ $settings['company_country'] }}<br><br>{{ $settings['company_phone'] }}<br>{{ $settings['company_email'] }}</p>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-4 col-xs-6">
                    <h6 class="type--uppercase">Menu</h6>
                    
                    @if(empty(parseSecAttr('navigation', $section['extras'])))
						@php( $menu = DB::table('menus')->where('id', '!=', 1)->first() )	
						@php( $menuId = $menu->id)
					@else
						@php( $menuId = parseSecAttr('navigation', $section['extras']))
					@endif
						
					@php($menus = Session::get('menus'))	
					@php( $menu = $menus[$menuId] )
                    
                    <ul class="list--hover">
                        @foreach($menu['items'] as $item)
	                            
                        <li> 
                        	<a href="{{ $item['link'] }}">{{ $item['name'] }}</a> 
                        </li>
                        
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm-6 col-md-4 col-xs-6">
                    <h6 class="type--uppercase">Kantooruren</h6>
                    <ul class="list--hover">
                        <p>Mon: {{ $settings['company_monday'] }}<br>
                        Tue: {{ $settings['company_monday'] }}<br>
                        Wed: {{ $settings['company_monday'] }}<br>
                        Thu: {{ $settings['company_monday'] }}<br>
                        Fri: {{ $settings['company_monday'] }}<br>
                    </ul>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-6"> <span class="type--fine-print">© <span class="update-year"></span> {{ $settings['company_name'] }}</span> <a class="type--fine-print" href="#">Privacy Policy</a> <a class="type--fine-print" href="#">Legal</a> </div>
                <div class="col-sm-6 text-right text-left-xs">
                    <ul class="social-list list-inline list--hover">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
{!! constructDividers($section) !!}
</section>