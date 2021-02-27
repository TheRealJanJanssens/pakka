<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
			{!! Form::myInput('text', 'name', 'Naam') !!}
			
			{!! Form::myInput('text', 'code', 'Code', [], $coupon['code'] ?? strtoupper(generateString(10)) ) !!}
			
			<div class="row">
				<div class="col-sm-6">
					<?php
		                $types = translateConfigArray("variables.coupon_type");
	                ?>

					{!! Form::mySelect('type', 'Soort coupon', $types, null, ['class' => 'form-control select2', 'data-search' => '-1']) !!}
				</div>
				
				<div class="col-sm-6">
					<div class="form-group">
						<label>Verval datum</label>

						<div class="input-group pick-date">
							<input type="text" name="expiry_date" class="form-control" value="{{ $coupon['expiry_date'] ?? '' }}">
							
							<div class="input-group-append">
								<span class="input-group-text input-group-addon"><i class="far fa-clock"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
<!--
			@foreach ($lang as $langItem)
				{!! Form::myInput('text', 'name', 'Naam', [], null, $langItem["language_code"]) !!}
			@endforeach
-->
			
			<div class="row input-tabs" data-name="is_fixed">
				<div class="col-sm-6">
					<div class="input-tab-list">
						<div class="form-group input-tab-item" data-id="1">
							<label>Korting</label>
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text input-group-addon"><i class="fa fa-euro"></i></span>
								</div>
								
								<input type="number" name="discount" class="form-control input-sync" value="{{ $coupon['discount'] ?? '' }}" step="0.01">
							</div>
						</div>
						
						<div class="form-group input-tab-item" data-id="0">
							<label>Korting</label>
							<div class="input-group">
								<input type="number" name="discount" class="form-control input-sync" value="{{ $coupon['discount'] ?? '' }}" step="0.01">
								
								<div class="input-group-append">
									<span class="input-group-text input-group-addon"><i class="fa fa-percentage"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-6">
					<?php
		                $types = [
			            	"1" => trans('pakka::app.fixed'),
			            	"0" => trans('pakka::app.percentage')  
		                ];
	                ?>

					{!! Form::mySelect('is_fixed', 'Type', $types, null, ['class' => 'form-control select2', 'data-search' => '-1']) !!}
				</div>
			</div>
			
		</div>  
	</div>
	
	<div class="col-sm-4">
		{{ constructTransSelect() }}
		
		<div class="bgc-white p-20 mB-30 bd">
			<p><b>{{ trans('pakka::app.settings') }}:</b></p>
			<div class="list-group list-group-status">
					
				@if (isset($coupon['status']))
					@switch($coupon['status'])
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
		
		<button type="submit" class="btn btn-primary-gradient">{{ trans('pakka::app.save_button') }}</button>
	</div>
</div>