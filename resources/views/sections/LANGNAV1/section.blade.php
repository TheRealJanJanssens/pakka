<section class="p-2 {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
	<div class="container">
        <?php
	        $langs = Session::get('lang');

	        foreach($langs as $lang){
		        ?>
		        <a href="/{{ $lang['language_code'] }}/{{ $page['meta']['slug'] }}" class="lang d-inline ml-1 mr-1">
			        <img src="/public/vendor/images/lang/{{ $lang['language_code'] }}.png" alt="{{ $lang['name'] }}">
			    </a>
		        <?php
	        }
        ?>
	</div>
{!! constructDividers($section) !!}
</section>