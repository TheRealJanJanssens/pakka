<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
				{{ $menuItem->name }}
				@foreach ($lang as $langItem)
					{!! Form::myInput('text', 'name', 'Naam', [], null, $langItem["language_code"]) !!}
				@endforeach

				@if(checkAccess("permission_edit_app_menu"))
					{!! Form::mySelect('icon', 'Icoon', config('pakka.icons'), null, ['class' => 'menu-check form-control select2']) !!}
				@endif

				{!! Form::mySelect('menu', 'Menu', $menus, null, ['class' => 'menu-check form-control select2']) !!}

				@php( $roles = config('pakka.roles') + config('pakka.adminRoles'))

				@if(checkAccess("permission_edit_app_menu"))
					{!! Form::mySelect('permission', 'Toegankelijkheid', $roles, null, ['class' => 'form-control select2']) !!}
				@endif

				@if(checkAccess("permission_edit_app_menu"))
					@php( $links = array(trans("pakka::app.pages") => $pages, trans("pakka::app.controlpanel") => config('pakka.modules')) )
				@else
					@php( $links = $pages )
				@endif

				{!! Form::mySelect('link', 'Link', $links, null, ['class' => 'form-control select2']) !!}
		</div>
	</div>

	<div class="col-sm-4">

		<a href="#" class="btn btn-white btn-icon-a btn-w-100 mB-40">Ga naar deze link<i class="ti-eye"></i></a>

		{{ constructTransSelect() }}

		<button type="submit" class="btn btn-primary">{{ trans('pakka::app.edit_button') }}</button>
		@if(checkAccess("permission_edit_app_menu"))
			<p class="text-subinfo font-italic mT-20">
				Icons worden enkel in het beheerpaneel gebruikt!
			</p>
		@endif
	</div>
</div>
