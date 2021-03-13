@extends('pakka::admin.default')

@section('page-header')
    @if(Session::has('module_name'))
		{{ Session::get('module_name') }}
	@endif
	 
	<small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')

    <div class="mB-20">
        <a href="{{ route(config('pakka.prefix.admin'). '.coupons.create') }}" class="btn btn-info">
            {{ trans('pakka::app.add_button') }}
        </a>
    </div>


    <div class="table-container bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-list table-striped" cellspacing="0" width="100%"> <!-- table-bordered -->
            <thead>
                <tr>
                    <th>{{ trans('pakka::app.name') }}</th>
                    <th>{{ trans('pakka::app.discount') }}</th>
                    <th>{{ trans('pakka::app.code') }}</th>
                    <th>{{ trans('pakka::app.status') }}</th>
                    <th>{{ trans('pakka::app.expiry_date') }}</th>
                    <th></th>
                </tr>
            </thead>
            
<!--
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
-->
            
            <tbody>
                @foreach ($coupons as $coupon)
                    <tr>
                        <td><a href="{{ route(config('pakka.prefix.admin'). '.coupons.edit', $coupon['id']) }}">{{ $coupon['name'] }}</a></td>
                        <td>
	                        <div class="pillbox pillbox-blue">
		                        @if($coupon['is_fixed'] == 1)
		                        	-€{{ $coupon['discount'] }}
		                        @else
		                        	-{{ $coupon['discount'] }}%
		                        @endif
	                        </div>
	                    </td>
                        <td><b>{{ $coupon['code'] }}</b></td>
                        <td>
	                        <?php
		                        //if you want to consider time with the expiry date change all 'Y-m-d' to 'Y-m-d H:i'
		                        
		                        if(strtotime(date('Y-m-d')) >= strtotime(formatDate($coupon['expiry_date'],'Y-m-d'))){
			                        $coupon['status'] = 3;
		                        }
		                        
		                        switch (true) {
			                        case $coupon['status'] == 0:
		                                $text = trans('pakka::app.not_active');
		                                $class = "";
		                                break;
		                            case strtotime(date('Y-m-d')) <= strtotime(formatDate($coupon['expiry_date'],'Y-m-d')) && ( empty($coupon['uses']) || $coupon['type'] == 2):
		                                $text = trans('pakka::app.active');
		                                $class = "pillbox-green";
		                                break;
		                            case strtotime(date('Y-m-d')) < strtotime(formatDate($coupon['expiry_date'],'Y-m-d')) && !empty($coupon['uses']) && $coupon['type'] == 1:
		                                $text = trans('pakka::app.used');
		                                $class = "pillbox-orange";
		                                break;
		                            case strtotime(date('Y-m-d')) > strtotime(formatDate($coupon['expiry_date'],'Y-m-d')):
		                                $text = trans('pakka::app.expired');
		                                $class = "pillbox-red";
		                                break;
		                        }
	                        ?>
	                        <div class="pillbox {{ $class }}">{{ $text }}</div>
                        </td>
                        <td>{!! formatDate($coupon['expiry_date'],'d-m-Y') !!}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(config('pakka.prefix.admin'). '.coupons.edit', $coupon['id']) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(config('pakka.prefix.admin'). '.coupons.destroy', $coupon['id']), 
                                        'method' => 'DELETE',
                                        ]) 
                                    !!}

                                        <button class="btn btn-danger btn-sm" title="{{ trans('pakka::app.delete_title') }}"><i class="ti-trash"></i></button>
                                        
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        
        </table>
    </div>

@endsection