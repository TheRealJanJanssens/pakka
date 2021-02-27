<div class="row">
	<div class="col-sm-8">
		<div class="bgc-white mB-40 p-20 bd">
			
			@php( $itemId = Session::get('current_item_id') )
			
			@php(constructInputs($inputs,2))

			@php(listImages($itemId, $item,'images'))
		</div> 
	</div>
	
	<div class="col-sm-4">
		
		{{ constructTransSelect() }}
		
		<button type="submit" class="btn btn-primary">{{ trans('pakka::app.edit_button') }}</button>
		
	</div>
</div>