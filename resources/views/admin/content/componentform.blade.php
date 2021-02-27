<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
				
			{!! Form::myInput('text', 'name', 'Naam', [], null) !!}
			
			{!! Form::myInput('text', 'slug', 'Slug', [], null) !!}
			
			{!! Form::myInput('number', 'position', 'Position', [], null, null) !!}
			
			{!! Form::myInput('hidden', 'page_id', null, [], $page) !!}
			
			{!! Form::myInput('hidden', 'section_id', null, [], $section) !!}
				
		</div>  
	</div>
	
	<div class="col-sm-4">

<!-- 		{{ constructTransSelect() }} -->
		
		<button type="submit" class="btn btn-primary">{{ trans('pakka::app.add_button') }}</button>
	</div>
	
</div>