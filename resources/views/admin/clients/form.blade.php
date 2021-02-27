<div class="row mB-40">
	
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			
			<h5 class="mB-20">{{ trans("pakka::app.personal_info") }}</h5>
			
			<hr>
			
			<div class="row">
				<div class="col-sm-6">
					{!! Form::myInput('text', 'firstname', trans("pakka::app.firstname")) !!}
				</div>
				
				<div class="col-sm-6">
					{!! Form::myInput('text', 'lastname', trans("pakka::app.lastname")) !!}
				</div>
			</div>
			
			
			
			<div class="row">
				<div class="col-sm-6">
					{!! Form::myInput('text', 'address', trans("pakka::app.address")) !!}
				</div>
				
				<div class="col-sm-6">
					{!! Form::myInput('text', 'city', trans("pakka::app.city")) !!}
				</div>
			</div>
			
			<div class="row">					
				<div class="col-sm-6">
					{!! Form::myInput('text', 'zip', trans("pakka::app.zip")) !!}
				</div>
				<div class="col-sm-6">
					{!! Form::myInput('text', 'country', trans("pakka::app.country")) !!}
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-6">
					{!! Form::myInput('text', 'email', trans("pakka::app.email")) !!}
				</div>
				
				<div class="col-sm-6">
					{!! Form::myInput('text', 'phone', trans("pakka::app.phone")) !!}
				</div>
			</div>
			
			<h5 class="mB-20 mT-40">{{ trans("pakka::app.company_info") }}</h5>
			
			<hr>
			
			{!! Form::myInput('text', 'company_name', trans("pakka::app.company_name")) !!}
			
			{!! Form::myInput('text', 'vat', trans("pakka::app.vat")) !!}
			
			<h5 class="mB-20 mT-40">{{ trans("pakka::app.extra_info") }}</h5>
			
			<hr>
			
			{!! Form::myTextArea('bio', trans("pakka::app.description")) !!}
			
			<div class="row">
				<div class="col-sm-6">
					{!! Form::myInput('password', 'password', trans("pakka::app.password")) !!}
				</div>
				
				<div class="col-sm-6">
					{!! Form::myInput('password', 'password_confirmation', trans("pakka::app.password_again")) !!}
				</div>
			</div>
			
			<button type="submit" class="btn btn-primary-gradient">{{ trans('pakka::app.save_button') }}</button>
		</div>  
	</div>
	
	<div class="col-sm-4">
		
		<button type="submit" class="btn btn-primary-gradient">{{ trans('pakka::app.save_button') }}</button>
		
	</div>
</div>