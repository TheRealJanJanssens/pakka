<div class="row">
	<div class="col-sm-8">
		@php($i=1)
		@foreach ($settings as $group)
			<!-- if you want to exclude more groups use the contain() function -->
<!-- 		($group['category'] == "app.settings_assets.permission_settings" && checkAcces('permission_perm_edit')) || $group['category'] !== "app.settings_assets.permission_settings" -->
			
			<?php
				//Checks admin settings
				$accesCheck = array(
					'app.settings_assets.permission_settings' => 'permission_perm_edit',
					'app.settings_assets.app_images' => 'permission_edit_admin_images',
					'app.settings_assets.invoice_settings' => 'permission_show_invoice_settings',
					'app.settings_assets.image_settings' => 'permission_show_image_optimization',
					'app.settings_assets.style_settings' => 'permission_show_style_options',
					'app.settings_assets.page_role_settings' => 'permission_edit_page_roles'
				);
				
				$parseGroup = true;
				foreach($accesCheck as $name => $label){
					if($name == $group['category']){
						if(!checkAcces($label)){
							$parseGroup = false;
						}
					}
				}
			?>
			
			@if($parseGroup ==  true)
				<div class="settings-group bgc-white mB-20 p-20 bd">
					@php( $categories[$i] = trans('pakka::'.$group['category']))
					<p id="{{ $i }}" class="mB-0 settings-link" data-id="{{ $i }}">
						<b>{{ trans('pakka::'.$group['category']) }}:</b>
						<i class="ti-angle-left"></i>
					</p>
					
					<div class="settings-inputs" data-id="{{ $i }}">
					@php(constructInputs($group['inputs'],1,true))
					</div>
					
				</div>
				
			@endif
			@php($i++)
		@endforeach 
	</div>
	
	<div class="col-sm-4">
		
		<div class="bgc-white p-20 mB-40 bd">
			@php($i=1)
			@foreach($categories as $key => $item)
				<a href="#{{ $key }}" class="link d-block mB-10 settings-link" data-id="{{ $i }}">{{ $item }}</a>
				@php($i++)
			@endforeach
		</div>
		
		{{ constructTransSelect() }}
		
		<button type="submit" class="btn btn-primary-gradient">{{ trans('pakka::app.edit_button') }}</button>
		
	</div>
</div>