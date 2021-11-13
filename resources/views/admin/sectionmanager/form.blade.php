<div class="row mB-40">
	
	<!-- admin protection -->
	@if(isset($item))
		@php($role = $item->role)
	@else
		@php($role = 5)
	@endif
	
	@if(($role == 10 && checkAccess("permission_user_admin_edit")) || $role !== 10)
	
		<div class="col-sm-8">
			<div class="bgc-white p-20 bd">
				{!! Form::myInput('text', 'id', 'ID') !!}

				{!! Form::myInput('text', 'name', 'Titel') !!}

				{!! Form::myInput('text', 'section', 'Section slug') !!}

				{!! Form::myInput('text', 'tags', 'Tags') !!}

				{!! Form::mySelect('type', 'Type', [1 => "navigation",2 => "main",3 => "footer"], null, ['class' => 'form-control select2']) !!}

			</div>  
		</div>
		
		<div class="col-sm-4">
			
			<div class="bgc-white p-20 mB-40 bd">
				
				<?php
					$roles = config('pakka.roles');
					
					if(checkAccess("permission_user_admin_edit")){
						$roles = $roles + config('pakka.adminRoles');
					}
				?>
				
				{!! Form::mySelect('permission', 'Rol', $roles, null, ['class' => 'form-control select2']) !!}
			</div>
			
			<button type="submit" class="btn btn-primary">{{ trans('pakka::app.edit_button') }}</button>
			
		</div>
	
	@else
		<div class="col-sm-12">
			<div class="bgc-white p-20 bd">
				
				<div class="peanut-jar">
					<img src="/public/vendor/images/pindakaas.svg">
				</div>
				
				<div class="alert alert-danger text-center" role="alert">Helaas pindakaas! Jij hebt geen toegang om deze gebruiker te bewerken.</div>
			</div>
		</div>
	@endif
</div>