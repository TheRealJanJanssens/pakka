<div class="bgc-white p-20 bd">
	
	{!! Form::myInput('title', 'title', 'Afspraak') !!}
	
	{!! Form::myPrice('price', 'Prijs') !!}
	
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label>Start</label>
				
				@if(isset($booking))
					@php($start = $booking->start_at)
				@else
					@php($start = "")
				@endif
				
				<div class="input-group pick-date">
					<input type="text" name="start_at" class="form-control" value="{{ $start }}">
					
					<div class="input-group-append">
						<span class="input-group-text input-group-addon"><i class="far fa-clock"></i></span>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-sm-6">
			<div class="form-group">
				<label>Einde</label>
				
				@if(isset($booking))
					@php($end = $booking->end_at)
				@else
					@php($end = "")
				@endif
				
				<div class="input-group pick-date">
					<input type="text" name="end_at" class="form-control" value="{{ $end }}">
					
					<div class="input-group-append">
						<span class="input-group-text input-group-addon"><i class="far fa-clock"></i></span>
					</div>
				</div>
			</div>
		</div>
	</div>		
	@switch($settings['booking_type'])
	  @case(1)
      <?php
    		$providers = TheRealJanJanssens\Pakka\Models\Provider::constructSelect();
    	?>
    	@if($providers)
			  {!! Form::mySelect('provider_id', trans('pakka::app.appointment_with'), $providers, null, ['class' => 'form-control select2 select-custom-input']) !!}
			@endif
			<?php
				$services = TheRealJanJanssens\Pakka\Models\Service::constructSelect();
			?>
			@if($services)
			  {!! Form::mySelect('service_id', trans('pakka::app.appointment_for'), $services, null, ['class' => 'form-control select2 select-custom-input']) !!}
			@endif
      @break
		@case(2)  
	    <?php
				$providers = TheRealJanJanssens\Pakka\Models\Provider::constructSelect();
			?>
			@if($providers)
			  {!! Form::mySelect('provider_id', trans('pakka::app.reservation_for'), $providers, null, ['class' => 'form-control select2 select-custom-input']) !!}
			@endif   
	    @break
	@endswitch
	
	
	{!! Form::myTextArea('description', 'Beschrijving') !!}
	
	@if(isset($booking))
		<span class="btn btn-danger d-block event-delete" data-id="{{ $booking->id }}"><i class="ti-trash mR-5"></i><b>Verwijder afspraak</b></span>
	@endif
	
</div>