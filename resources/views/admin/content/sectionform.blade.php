<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
				
			{!! Form::myInput('text', 'name', 'Naam', [], null) !!}
			
			{!! Form::myInput('number', 'position', 'Position', [], null, null) !!}
			
			<!-- Type veld? -->
			
			{!! Form::myInput('hidden', 'page_id', null, [], $page) !!}
			
			{!! Form::mySelect('section', 'Sections', $sections, null, ['class' => 'form-control select2']) !!}
			
			{!! Form::myTextArea('attributes', 'Attributes', [], null) !!}
				
		</div>  
	</div>
	
	<div class="col-sm-4">

		<div class="bgc-white p-20 mB-30 bd">
			<p><b>{{ trans('pakka::app.settings') }}:</b></p>
			
			<div class="list-group list-group-status">
				
				@if (isset($section->status))
					@switch($section->status)
				    	@case(1)
							@php( $onlineClass = "active" )
							@php( $offlineClass = "" )
				        @break
				        	
				        @case(0)
							@php( $onlineClass = "" )
							@php( $offlineClass = "active" )
				        @break
				    @endswitch
				@else    
				    @php( $onlineClass = "active" )
					@php( $offlineClass = "" )
				@endif
								
				<a href="#" class="list-group-item list-group-item-action list-group-head {{ $onlineClass }}" data-status="1">{{ trans('pakka::app.active') }}</a>
				<a href="#" class="list-group-item list-group-item-action {{ $offlineClass }}" data-status="0">{{ trans('pakka::app.not_active') }}</a>
			</div>
			{!! Form::myInput('hidden', 'status', '', ["class" => "status-input"]) !!}
			
		</div>
				
		<button type="submit" class="btn btn-primary">{{ trans('pakka::app.add_button') }}</button>
	</div>
	
</div>