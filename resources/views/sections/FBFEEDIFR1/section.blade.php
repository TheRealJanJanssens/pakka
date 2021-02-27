<section class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
	<div class="container text-center">
		<?php
	        $settings = Session::get('settings');

	        //convert fb link for fb feed
			 $fbFeedUrl = urlencode($settings['social_facebook']);
	    ?>

		@if(checkCookie('laravel_cookie_consent') || isLocalhost())
			<div class="iframe_conatiner mx-auto mb-5">
		    	<iframe src="https://www.facebook.com/plugins/page.php?href={{ $fbFeedUrl }}&tabs=timeline&width=500&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=163260228127333" width="auto" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media" class="fb-feed fb-feed-full  e {{ parseSecAttr('.e', $section['classes']) }}"></iframe>
		    	
<!-- 		    	<canvas id="c"></canvas> -->
			</div>
	    @endif
	    
	    @if(checkContent($section['FBFEEDIFR1_H'], 'title'))
	    	<h4>{{ parseContent($section['FBFEEDIFR1_H'],'title') }}</h4>
	    @endif
	    
		@if(isset($settings['social_facebook']))
            <a href="{{ $settings['social_facebook'] }}" class="btn btn--primary type--uppercase font-weight-bold e {{ parseSecAttr('.e', $section['classes']) }}">
			    <span class="btn__text"><i class="fa fa-facebook icon icon--xs btn__icon mr-3"></i>{{ parseContent($section['FBFEEDIFR1_H'],'button') }}</span>
			</a>
        @endif
		
	</div>
{!! constructDividers($section) !!}
</section>