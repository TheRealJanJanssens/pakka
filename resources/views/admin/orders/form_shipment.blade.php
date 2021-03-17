@extends('pakka::admin.default')

@section('page-header')
	Bestelling	 
	<small>
		{{ $order['name'] }}
		{{ getOrderFulfillmentStatus($order['fulfillment_status']) }}
		{{ getOrderFinancialStatus($order['financial_status']) }}
	</small>
@endsection

@section('content')
	{!! Form::model($order['shipment'], [
			'action' => ['TheRealJanJanssens\Pakka\Http\Controllers\OrderController@updateShipment', $order['shipment']['id']],
			'method' => 'put', 
			'files' => true
		])
	!!}
		<div class="row mB-40">
			<div class="col-sm-8">
				<div class="bgc-white p-20 mB-20 bd">
					<div class="row">
						<div class="col-md-6">
							{!! Form::myInput('text', 'firstname', trans('pakka::app.firstname')) !!}
						</div>
						
						<div class="col-md-6">
							{!! Form::myInput('text', 'lastname', trans('pakka::app.lastname')) !!}
						</div>
					</div>
					
					{!! Form::myInput('text', 'address', trans('pakka::app.address')) !!}
					
					<div class="row">
						<div class="col-md-3">
							{!! Form::myInput('text', 'zip', trans('pakka::app.zip')) !!}
						</div>
						
						<div class="col-md-6">
							{!! Form::myInput('text', 'city', trans('pakka::app.city')) !!}
						</div>
						
						<div class="col-md-3">
							<?php
								$regions = App\ShipmentOption::getAvailableRegions();
							?>
							
							{!! Form::mySelect('country', 'Land', $regions, null, ['class' => 'form-control select2', 'data-search' => '-1']) !!}
						</div>
					</div>
					
					<?php
		                //Translates all the condition operators
						$carriers = translateConfigArray("pakka.shipment_carrier");
		            ?>
		
					{!! Form::mySelect('carrier', 'Koerier', $carriers, null, ['class' => 'form-control select2', 'data-search' => '-1']) !!}
					
					{!! Form::myInput('text', 'track_code', trans('pakka::app.track_code')) !!}
					
				</div>
			</div>
		
			<div class="col-sm-4">
				<div class="bgc-white p-20 mB-30 bd">
					<p><b>{{ trans('pakka::app.settings') }}:</b></p>
					<div class="list-group list-group-status">			
						<a href="#" class="list-group-item list-group-item-action list-group-head active" data-status="1">{{ trans('pakka::app.send_mail') }}</a>
						<a href="#" class="list-group-item list-group-item-action" data-status="0">{{ trans('pakka::app.no_mail') }}</a>
					</div>
					{!! Form::myInput('hidden', 'status', '', ["class" => "status-input"]) !!}
				</div>
				
				<button type="submit" class="btn btn-primary-gradient">{{ trans('pakka::app.save_button') }}</button>
			</div>
		</div>
		
	{!! Form::close() !!}
	
@stop