<section id="{{ $section['id'] }}" class="switchable {{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-md-8 col-lg-7">
                <form class="text-left form-email row mx-0" action="/actions/mail/general/1" data-success="{{ trans('pakka::form.form_success') }}" data-error="{{ trans('pakka::form.form_error') }}">
	                <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                @honeypot

                    <div class="col-md-12">
	                    <label>{{ trans('pakka::form.your_name') }}:</label>
	                    <input type="text" name="naam" class="validate-required e {{ parseSecAttr('.e', $section['classes']) }}">
	                </div>

                    <div class="col-md-6">
	                    <label>{{ trans('pakka::form.phone') }}:</label>
	                    <input type="text" name="telefoon" class="validate-required e {{ parseSecAttr('.e', $section['classes']) }}">
	                </div>

	                <div class="col-md-6">
	                    <label>{{ trans('pakka::form.email') }}:</label>
	                    <input type="email" name="email" class="validate-required validate-email e {{ parseSecAttr('.e', $section['classes']) }}">
	                </div>

	                <div class="col-md-6">
	                    <label>{{ trans('pakka::form.address') }}:</label>
	                    <input type="text" name="adres" class="validate-required e {{ parseSecAttr('.e', $section['classes']) }}">
	                </div>

	                <div class="col-md-6">
	                    <label>{{ trans('pakka::form.zip') }}:</label>
	                    <input type="text" name="postcode" class="validate-required e {{ parseSecAttr('.e', $section['classes']) }}">
	                </div>

                    <div class="col-md-12">
	                    <label>{{ trans('pakka::form.message') }}:</label>
	                    <textarea rows="6" name="bericht" class="validate-required e {{ parseSecAttr('.e', $section['classes']) }}"></textarea>
	                </div>

                    <div class="col-md-5 col-lg-4">
	                    <button type="submit" class="btn btn--primary type--uppercase e {{ parseSecAttr('.e', $section['classes']) }}">{{ parseContent($section['FRMLNGTXT1_F'],'button') }}</button>
	                </div>
                </form>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="text-block">
                    <h5>{{ trans('pakka::form.contact_info') }}</h5>
					<p>
	                    @if($settings['company_phone'])
	                    	<a href="tel:{{ $settings['company_phone'] }}"><i class="fa fa-phone mr-2"></i>{{ $settings['company_phone'] }}</a><br>
	                    @endif

	                    @if($settings['company_email'])
	                    	<a href="mailto:{{ $settings['company_email'] }}"><i class="fa fa-envelope-o mr-2"></i>{{ $settings['company_email'] }}</a>
	                    @endif
					</p>

					<?php
						$smLinks = constructSocialMediaLinks();
						if(!empty($smLinks)){
							foreach($smLinks as $smLink){
								?>
								<a href="{{ $smLink['link'] }}" target="_blank" class="mr-2"> <i class="{{ $smLink['icon'] }} icon icon--xs"></i> </a>
								<?php
							}
						}
					?>

                </div>
                <div class="text-block">
                    <h5>{{ trans('pakka::form.address') }}</h5>
                    <p>
                        {{ $settings['company_address'] }}<br>{{ $settings['company_zip'] }} {{ $settings['company_city'] }}<br>{{ $settings['company_country'] }}

                        @if($settings['company_vat'])
                            {{ $settings['company_vat'] }}<br>
                        @endif
                    </p>
                </div>

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
