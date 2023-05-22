<livewire:users-form />
















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
				{!! Form::myInput('text', 'name', 'Username') !!}

					{!! Form::myInput('email', 'email', 'Email') !!}

					{!! Form::myInput('password', 'password', 'Password') !!}

					{!! Form::myInput('password', 'password_confirmation', 'Password again') !!}


					{!! Form::myFile('avatar', 'Avatar') !!}

					{!! Form::myTextArea('bio', 'Bio') !!}
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

				{!! Form::mySelect('role', 'Rol', $roles, null, ['class' => 'form-control select2']) !!}
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
