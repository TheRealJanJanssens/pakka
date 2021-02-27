<div class="row">
	<div class="col-sm-8">
		<div class="bgc-white mB-40 p-20 bd">
			
			@php( $itemId = Session::get('current_item_id') )
			
			@php(constructInputs($inputs,2))
			
			@if(isset($item))
				@php(listImages($itemId, $item,'images'))
			@endif
		</div> 
	</div>
	
	<div class="col-sm-4">
		
		<div class="bgc-white p-20 mB-40 bd">
			<p><b>{{ trans('pakka::app.settings') }}:</b></p>
			@foreach ($lang as $langItem)
				{!! Form::myInput('text', 'slug', null, ["class" => "form-control slug-input", "placeholder" => "slug"], null, $langItem["language_code"]) !!}
			@endforeach
			
			<div class="list-group list-group-status">
				
				@if (isset($item['status']))
					@switch($item['status'])
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
								
				<a href="#" class="list-group-item list-group-item-action list-group-head {{ $onlineClass }}" data-status="1">{{ trans('pakka::app.online') }}</a>
				<a href="#" class="list-group-item list-group-item-action {{ $offlineClass }}" data-status="0">{{ trans('pakka::app.offline') }}</a>
			</div>
			{!! Form::myInput('hidden', 'status', '', ["class" => "status-input"]) !!}
			
		</div>
		
		{{ constructTransSelect() }}
		
<!--
		<div class="bgc-white p-20 mB-40 bd">
			<p><b>{{ trans('pakka::app.report.title') }}</b></p>
			<p>{{ trans('pakka::app.report.text') }}</p>
			
		</div>
-->
		
		<button type="submit" class="btn btn-primary">{{ trans('pakka::app.edit_button') }}</button>
		
	</div>
</div>