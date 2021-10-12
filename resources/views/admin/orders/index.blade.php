@extends('pakka::admin.default')

@section('page-header-alt')
	<h4 class="c-grey-900 mT-10">
		@if(Session::has('module_name'))
            {{ Session::get('module_name') }}
        @endif	 
		<small>{{ trans('pakka::app.manage') }}</small>
	</h4>
@endsection

@section('content')

    <div class="row pX-15 pT-5 pB-30">
        <div class="dropdown">
            <a href="#" id="mail-dropdown" class="text-body mr-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{-- <i class="far fa-save mr-1"></i> --}}
                {{ trans('pakka::app.more_actions') }}
                <i class="fa fa-caret-down"></i>
            </a>
            
            <div class="dropdown-menu" aria-labelledby="mail-dropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
                <p class="mb-2"><b class="pX-15">Excel Export</b></p>
                
                <a class="dropdown-item" href="/export/excel/orders">
                    <i class="ti-download text-primary mR-10"></i>
                    {{ trans('pakka::app.download.excel.all_orders') }}
                </a>
                
                <a class="dropdown-item" href="/export/excel/orders/completed">
                    <i class="ti-download text-primary mR-10"></i>
                    {{ trans('pakka::app.download.excel.all_completed_orders') }}
                </a>

                <a class="dropdown-item" href="/export/excel/invoices">
                    <i class="ti-download text-primary mR-10"></i>
                    {{ trans('pakka::app.download.excel.all_invoices') }}
                </a>
            </div>
        </div>
    </div>

    <div class="table-container bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-list table-striped" cellspacing="0" width="100%"> <!-- table-bordered -->
            <thead>
                <tr>
                    <th>{{ trans('pakka::app.order_no') }}</th>
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
                        <td><a href="{{ route(config('pakka.prefix.admin'). '.orders.show', $order['id']) }}">{{ $order['order_id'] }}</a></td>
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
                                    <a href="{{ route(config('pakka.prefix.admin'). '.orders.show', $order['id']) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-eye"></span></a></li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        
        </table>
    </div>

@endsection