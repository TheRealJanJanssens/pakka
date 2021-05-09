<section id="{{ $section['id'] }}" class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container text-center-xs">
            <div class="row">
	            
	            <?php
			        $settings = Session::get('settings');
			        
			        //social media links
			        $smLinks = constructSocialMediaLinks();
			        
			        //adress for google maps
			        $address = str_replace(" ", "%20", $settings['company_address'].' '.$settings['company_city']);
			        
			        //convert fb link for fb feed
			        $fbFeedUrl = urlencode($settings['social_facebook']);
			    ?>
	            
	            @for ($i = 1; $i < 5; $i++)
	            	@php( $key = "footer_column_".$i )
				    @if(isset($section['extras'][$key]))
		            	<div class="col-sm-6 col-md-3 col-xs-6">
			                @switch($section['extras'][$key])
							    @case('about-us')
							        @if(isset($settings['app_logo']))
						            	<img class="logo mb-4 {{ parseSecAttr('.logo', $section['classes']) }}" src="{{ config('image.app.public') }}{{ $settings['app_logo'] }}" alt="Logo {{ $settings['company_name'] }}">
						            @else
						            	<img class="logo mb-4 {{ parseSecAttr('.logo', $section['classes']) }}" src="{{ config('placeholders.logo') }}" alt="Logo {{ $settings['company_name'] }}">
						            @endif
						            
						            @if(checkContent($section['FOOTLG02001_ABOUT'], 'title'))
								    	<h6 class="type--uppercase">{{ parseContent($section['FOOTLG02001_ABOUT'],'title') }}</h6>
								    @endif
								    
								    @if(checkContent($section['FOOTLG02001_ABOUT'], 'text'))
								    	<p>{{ parseContent($section['FOOTLG02001_ABOUT'],'text') }}</p>
								    @endif
								    
								    @if(checkContent($section['FOOTLG02001_ABOUT'], 'link'))
						                <a class="btn btn--primary type--uppercase e {{ parseSecAttr('.e', $section['classes']) }}" href="{{ $section['FOOTLG02001_ABOUT']['link'] }}">
							                <span class="btn__text">
												{{ parseContent($section['FOOTLG02001_ABOUT'],'button') }}
											</span> 
										</a>
						            @endif
						            
							        @break
							    @case('company-info')
							        <h6 class="type--uppercase">{{ $settings['company_name'] }}</h6>
				                    <ul class="list--hover">
				                        <p>
					                        @if($settings['company_address'])
					                        	{{ $settings['company_address'] }}<br>
					                        @endif
					                        
					                        @if($settings['company_city'])
					                        	{{ $settings['company_city'] }}<br>
					                        @endif
					                        
					                        @if($settings['company_country'])
					                        	{{ $settings['company_country'] }}<br>
					                        @endif
					                        
					                        <br>
					                        
					                        @if($settings['company_phone'])
					                        	<a href="tel:{{ $settings['company_phone'] }}" class="type--nodeco">{{ $settings['company_phone'] }}</a><br>
					                        @endif
					                        
					                        @if($settings['company_email'])
					                        	<a href="mailto:{{ $settings['company_email'] }}" class="type--nodeco">{{ $settings['company_email'] }}</a>
					                        @endif
										</p>
					                        
				                        @if(!empty($smLinks))
											@foreach($smLinks as $smLink)
												<a href="{{ $smLink['link'] }}" target="_blank" class="mr-2">
													<i class="{{ $smLink['icon'] }} icon icon--xs"></i>
												</a>
											@endforeach
										@endif
				                    </ul>
							        @break
							    @case('opening-hours')
							        @if(checkContent($section['FOOTLG02001_OPNH'], 'title'))
								    	<h6 class="type--uppercase">{{ parseContent($section['FOOTLG02001_OPNH'],'title') }}</h6>
								    @endif
								    
								    <ul class="list--hover">
				                        <p>{{ trans('pakka::app.days.mon') }}: {{ $settings['company_monday'] }}<br>
				                        {{ trans('pakka::app.days.tue') }}: {{ $settings['company_tuesday'] }}<br>
				                        {{ trans('pakka::app.days.wed') }}: {{ $settings['company_wednesday'] }}<br>
				                        {{ trans('pakka::app.days.thu') }}: {{ $settings['company_thursday'] }}<br>
				                        {{ trans('pakka::app.days.fri') }}: {{ $settings['company_friday'] }}<br>
				                        {{ trans('pakka::app.days.sat') }}: {{ $settings['company_saturday'] }}<br>
				                        {{ trans('pakka::app.days.sun') }}: {{ $settings['company_sunday'] }}<br>
				                    </ul>
							        @break
							    @case('menu')
							        @if(empty($section['extras']['menu_id']))
										@php( $menu = DB::table('menus')->where('id', '!=', 1)->first() )	
										@php( $menuId = $menu->id)
									@else
										@php( $menuId = $section['extras']['menu_id'])
									@endif
									
									@php($menus = Session::get('menus'))	
									@php( $menu = $menus[$menuId] )
				                    
				                    @if(checkContent($section['FOOTLG02001_MENU'], 'title'))
								    	<h6 class="type--uppercase">{{ parseContent($section['FOOTLG02001_MENU'],'title') }}</h6>
								    @endif
				                    
				                    <ul class="social-list list-inline list--hover d-block">
					                    @foreach($menu['items'] as $item)
					                            
					                        <li class="d-block m-0"> 
					                        	<a href="{{ $item['link'] }}">{{ $item['name'] }}</a> 
					                        </li>
				                        
				                        @endforeach
				                    </ul>
				                    
							        @break
							    @case('submenu')
							        @if(empty($section['extras']['submenu_id']))
										@php( $menu = DB::table('menus')->where('id', '!=', 1)->first() )	
										@php( $menuId = $menu->id)
									@else
										@php( $menuId = $section['extras']['submenu_id'])
									@endif
									
									@php($menus = Session::get('menus'))	
									@php( $menu = $menus[$menuId] )
				                	
				                	@if(checkContent($section['FOOTLG02001_SUBMENU'], 'title'))
								    	<h6 class="type--uppercase">{{ parseContent($section['FOOTLG02001_SUBMENU'],'title') }}</h6>
								    @endif
				                	
				                	<ul class="social-list list-inline list--hover d-block">
					                    @foreach($menu['items'] as $item)
					                            
					                        <li class="d-block m-0"> 
					                        	<a href="{{ $item['link'] }}">{{ $item['name'] }}</a> 
					                        </li>
				                        
				                        @endforeach
				                    </ul>
				                    
							        @break
							    @case('map-api')
							        <div class="map-container m-0 e {{ parseSecAttr('.e', $section['classes']) }}" data-maps-api-key="{{ config('maps.maps_api_key') }}" data-address="{{ $settings['company_address'] }} {{ $settings['company_city'] }}" data-marker_title="{{ $settings['company_name'] }}" {{ parseSecAttr('.e', $section['attributes']) }} @if(isset($section['extras']['map_style_key'])) data-map_style_key="{{ $section['extras']['map_style_key'] }}" data-map_style="{{ config( $section['extras']['map_style_key'] ) }}" @endif @if(isset($section['extras']['map_zoom'])) data-map_zoom="{{ $section['extras']['map_zoom'] }}" @endif></div>
							        @break
							    @case('map-iframe')
							        <div class="map-container m-0 e {{ parseSecAttr('.e', $section['classes']) }}">
								        <iframe src="https://maps.google.com/maps?width=100%&height=400&hl=nl&q={{$address}}+($settings['company_name'])&ie=UTF8&t=&z=14&iwloc=B&output=embed"></iframe>
								    </div>
							        @break
							    @case('fb-feed')
							    	@if(checkCookie('laravel_cookie_consent') || isLocalhost())
								        <iframe src="https://www.facebook.com/plugins/page.php?href={{ $fbFeedUrl }}&tabs=timeline&width=255&height=400&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=false&appId=163260228127333" width="255" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
							        @endif
							        
							        @break
							    @default
							        <h6 class="type--uppercase">{{ $settings['company_name'] }}</h6>
				                    <ul class="list--hover">
				                        <p>
					                        {{ $settings['company_address'] }}<br>
					                        {{ $settings['company_city'] }}<br>
					                        {{ $settings['company_country'] }}<br><br>
					                        
					                        @if($settings['company_phone'])
					                        	<a href="tel:{{ $settings['company_phone'] }}" class="type--nodeco">{{ $settings['company_phone'] }}</a><br>
					                        @endif
					                        
					                        @if($settings['company_email'])
					                        	<a href="mailto:{{ $settings['company_email'] }}" class="type--nodeco">{{ $settings['company_email'] }}</a>
					                        @endif
				                        </p>
				                            
					                        @if(!empty($smLinks))
												@foreach($smLinks as $smLink)
													<a href="{{ $smLink['link'] }}" target="_blank" class="mr-2">
														<i class="{{ $smLink['icon'] }} icon icon--xs"></i>
													</a>
												@endforeach
											@endif
				                    </ul>
							@endswitch
		                </div>
		            @endif
				@endfor
            </div>
            <div class="row mt-4">
                <div class="col-sm-8">
	                <a href="http://www.pakka.be" class="type--fine-print">Made By Päkka</a>
	                <span class="type--fine-print">
	                	© <span class="update-year"></span> {{ $settings['company_name'] }}
	                </span>
	                
	                @if(empty($section['extras']['credmenu_id']))
						@php( $menu = DB::table('menus')->where('id', '!=', 1)->first() )	
						@php( $menuId = $menu->id)
					@else
						@php( $menuId = $section['extras']['credmenu_id'])
					@endif
					
					@php($menus = Session::get('menus'))	
					@php( $menu = $menus[$menuId] )
                	
                	@foreach($menu['items'] as $item)

                    	<a class="type--fine-print mx-2" href="{{ $item['link'] }}">{{ $item['name'] }}</a> 
                    
                    @endforeach
                </div>
                <div class="col-sm-4 text-right text-left-xs">
                    <ul class="social-list list-inline list--hover">
	                    @if(!empty($smLinks))
							@foreach($smLinks as $smLink)
								<li>
									<a href="{{ $smLink['link'] }}" target="_blank">
										<i class="{{ $smLink['icon'] }} icon icon--xs"></i>
									</a>
								</li>
							@endforeach
						@endif
                    </ul>
                </div>
            </div>
        </div>
{!! constructDividers($section) !!}
</section>