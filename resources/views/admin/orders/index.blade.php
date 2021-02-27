@extends('pakka::admin.default')

@section('page-header')
    @if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif
	 
	<small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')

    <div class="table-container bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-list table-striped" cellspacing="0" width="100%"> <!-- table-bordered -->
            <thead>
                <tr>
                    <th>{{ trans('pakka::app.number') }}</th>
                    <th>{{ trans('pakka::app.name') }}</th>
                    <th>{{ trans('pakka::app.total') }}</th>
                    <th>{{ trans('pakka::app.fulfillment') }}</th>
                    <th>{{ trans('pakka::app.payment') }}</th>
                    <th>{{ trans('pakka::app.region') }}</th>
                    <th></th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td><a href="{{ route(ADMIN . '.orders.show', $order['id']) }}">{{ $order['order_id'] }}</a></td>
                        <td>
	                        <p>{{ $order['firstname'] }} {{ $order['lastname'] }}</p>
                        </td>
                        <td>
	                        <b>€{!! formatNumber($order['total']) !!}</b>
                        </td>
                        <td>
	                        {{ getOrderFulfillmentStatus($order['fulfillment_status']) }}
                        </td>
                        <td>
	                        {{ getOrderFinancialStatus($order['financial_status']) }}
                        </td>
                        <td>
	                        {{ $order['country'] }}
                        </td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.orders.show', $order['id']) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-eye"></span></a></li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        
        </table>
    </div>

@endsection