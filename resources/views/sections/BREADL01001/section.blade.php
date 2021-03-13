<section id="{{ $section['id'] }}" class="cta cta-4 border--bottom {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
	<div class="container">
	    <div class="row">
	        <div class="col-md-12">
		        <a href="/" >Home</a>
		        
		        @if(isset(Request()->param1))
		        	@php($pageName = TheRealJanJanssens\Pakka\Models\Translation::getTranslation(Route::getCurrentRoute()->getAction()['pageName']))
		        	@if(strtolower($settings['role_product_detail']) !== strtolower($pageName))
		        		<i class="fa fa-chevron-right type--fade type--fine-print mx-2"></i>
						<a href="{{ Route::getCurrentRoute()->getCompiled()->getStaticPrefix() }}">{{ $pageName }}</a>
					@else
						<i class="fa fa-chevron-right type--fade type--fine-print mx-2"></i>
						<a href="{!! url('/'.$settings['role_product_list']) !!}">{{ trans('pakka::webshop.products') }}</a>
		        	@endif

			        <i class="fa fa-chevron-right type--fade type--fine-print mx-2"></i>
					<a href="{{ Request::url() }}">{!! ucfirst(deslugify(Request()->param2)) !!}</a>
				@else
					<i class="fa fa-chevron-right type--fade type--fine-print mx-2"></i>
			        <a href="{{ Request::url() }}">{!! TheRealJanJanssens\Pakka\Models\Translation::getTranslation(Route::getCurrentRoute()->getAction()['pageName']) !!}</a>
		        @endif

		    </div>
	    </div>
	</div>
{!! constructDividers($section) !!}
</section>