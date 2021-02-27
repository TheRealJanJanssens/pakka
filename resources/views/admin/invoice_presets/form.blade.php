<div class="row mB-40">
	
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			
			{!! Form::myInput('text', 'name', trans("pakka::app.name")) !!}
			
			{!! Form::myInput('text', 'price', trans("pakka::app.price"), [], null, null, false, $settings['invoice_valuta'] ,false) !!}
			
			{!! Form::myInput('number', 'quantity', trans("pakka::app.quantity"), ['step' => '0.01', 'min' => '0']) !!}
			
			{!! Form::myInput('number', 'vat', trans("pakka::app.vatper"), ['min' => '0'], null, null, false, false, '%') !!}
			
			<button type="submit" class="btn btn-primary-gradient mT-10">{{ trans('pakka::app.save_button') }}</button>
		</div>  
	</div>
	
	<div class="col-sm-4">
		
		<button type="submit" class="btn btn-primary-gradient">{{ trans('pakka::app.save_button') }}</button>
		
	</div>
</div>