<section id="{{ $section['id'] }}" class="switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-8 col-lg-7">
                <h2>{{ parseContent($section['TXTLST01001_C1'],'title') }}</h2>
	            <p class="lead">{{ parseContent($section['TXTLST01001_C1'],'text') }}</p>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="text-block">
                    <h5>{{ trans('pakka::app.settings_assets.contact_info') }}</h5>
                    <p>
	                    @if($settings['company_phone'])
	                    	<a href="tel:{{ $settings['company_phone'] }}"><i class="fa fa-phone mr-2"></i>{{ $settings['company_phone'] }}</a><br>
	                    @endif
	                    
	                    @if($settings['company_email'])
	                    	<a href="mailto:{{ $settings['company_email'] }}"><i class="fa fa-envelope-o mr-2"></i>{{ $settings['company_email'] }}</a></p>
	                    @endif
                    
                </div>

            		@if($settings['company_address'] || $settings['company_zip'] || $settings['company_city'] || $settings['company_country'])
                        <div class="text-block">
                            <h5>{{ trans('pakka::app.settings_assets.address') }}</h5>
                            <p>{{ $settings['company_address'] }}<br>{{ $settings['company_zip'] }} {{ $settings['company_city'] }}<br>{{ $settings['company_country'] }}</p>
                        </div>
            		@endif 
                
                @if($settings['company_monday'] || $settings['company_tuesday'] || $settings['company_wednesday'] || $settings['company_thursday'] || $settings['company_friday'] || $settings['company_saturday'])
	                <div class="text-block">
	                    <h5>{{ trans('pakka::app.settings_assets.opening_hours') }}</h5>
	                    <p>
		                    @if($settings['company_monday'])
		                    	{{ trans('pakka::app.days.monday') }}: {{ $settings['company_monday'] }}<br>
		                    @endif
		                    
		                    @if($settings['company_tuesday'])
		                    	{{ trans('pakka::app.days.tuesday') }}: {{ $settings['company_tuesday'] }}<br>
		                    @endif
		                    
		                    @if($settings['company_wednesday'])
		                    	{{ trans('pakka::app.days.wednesday') }}: {{ $settings['company_wednesday'] }}<br>
		                    @endif
		                    
		                    @if($settings['company_thursday'])
		                    	{{ trans('pakka::app.days.thursday') }}: {{ $settings['company_thursday'] }}<br>
		                    @endif
		                    
		                    @if($settings['company_friday'])
		                    	{{ trans('pakka::app.days.friday') }}: {{ $settings['company_friday'] }}<br>
		                    @endif
		                    
		                    @if($settings['company_saturday'])
		                    	{{ trans('pakka::app.days.saturday') }}: {{ $settings['company_saturday'] }}<br>
		                    @endif
		                    
		                    @if($settings['company_sunday'])
		                    	{{ trans('pakka::app.days.sunday') }}: {{ $settings['company_sunday'] }}
		                    @endif
		                </p>
	                </div>
	            @endif
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>