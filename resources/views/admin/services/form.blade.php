<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			@foreach ($lang as $langItem)
				{!! Form::myInput('text', 'name', 'Naam', [], null, $langItem["language_code"]) !!}
			@endforeach
			
			<div class="row">
				<div class="col-sm-6">
					{!! Form::myPrice('price', 'Prijs') !!}
				</div>
				
				<div class="col-sm-6">
					<div class="form-group">
						<label>Tijd</label>
						
						@if(isset($service))
							@php($duration = $service['duration'])
						@else
							@php($duration = "")
						@endif
						
						<div class="input-group start-time">
							<input type="text" name="duration" class="form-control start-time" value="{{ $duration }}">
							
							<div class="input-group-append">
								<span class="input-group-text input-group-addon"><i class="far fa-clock"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			@foreach ($lang as $langItem)
				{!! Form::myTextArea('description', 'Beschrijving', [], null, $langItem["language_code"]) !!}
			@endforeach
			
			<?php
				$providers = TheRealJanJanssens\Pakka\Models\Provider::getProviders();
			?>
			
			<label>Selecteer medewerkers</label>
			<div class="container">
				<div class="row">
					@foreach ($providers as $provider)
						@if(isset($service))
							@if( in_array($provider->id, $service['providers']->toArray()) )
								@php($checked = true)
							@else
								@php($checked = false)
							@endif
						@else
							@php($checked = false)
						@endif
						
						{!! Form::myCheckbox('providers['.$provider['id'].']', $provider['name'], $provider['id'],0, $checked, [], 'col-sm-6 col-md-4 mB-10') !!}
					@endforeach
				</div>
			</div>
		</div>  
	</div>
	
	<div class="col-sm-4">
		{{ constructTransSelect() }}
		
		<button type="submit" class="btn btn-primary-gradient">{{ trans('pakka::app.save_button') }}</button>
	</div>
</div>