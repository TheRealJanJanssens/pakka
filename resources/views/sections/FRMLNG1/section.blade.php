<section class="{{ checkAdjustable() }} {{ checkManageable() }} {{ parseSecAttr('.adjustable', $section['classes']) }}" {{ parseEditSecAttr($page['meta']['mode'],$section) }} {{ parseSecAttr('.adjustable', $section['attributes']) }}>
    <div class="container">
        <div class="row justify-content-center no-gutters">
            <div class="col-md-8 col-lg-7">
                <form class="text-left form-email row mx-0" action="/actions/mail/general/1" data-success="{{ trans('pakka::form.form_success') }}" data-error="{{ trans('pakka::form.form_error') }}">
	                <input type="hidden" name="_token" value="{{ csrf_token() }}">
	                @honeypot
	                
					@if(!empty($section['extras']['form_id']))
						@php( $inputs = \TheRealJanJanssens\Pakka\Models\AttributeInput::getInputs($section['extras']['form_id']) )	
						
						@foreach($inputs as $input)
							<div class="col-md-12"> 
								<label>{{ $input['label'] }}:</label>
								<input type="{{ $input['type'] }}" name="{{ $input['name'] }}" class="validate-required e {{ parseSecAttr('.e', $section['classes']) }}">
							</div>
						@endforeach
					@else
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
					@endif
					
					<div class="col-md-5 col-lg-4">
						<button type="submit" class="btn btn--primary type--uppercase e {{ parseSecAttr('.e', $section['classes']) }}">{{ parseContent($section['FRMLNG1_F'],'button') }}</button>
					</div>

                </form>
            </div>
        </div>
    </div>
{!! constructDividers($section) !!}
</section>