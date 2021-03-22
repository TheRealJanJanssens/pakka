<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			
			{!! Form::myInput('text', 'name', 'Naam') !!}

			{!! Form::myFile('file', 'Template bestand') !!}

			<button type="submit" class="btn btn-primary-gradient">{{ trans('pakka::app.save_button') }}</button>
		</div>  
	</div>
	
	<div class="col-sm-4">

	</div>
</div>