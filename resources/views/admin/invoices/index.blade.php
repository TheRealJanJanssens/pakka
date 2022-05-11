@extends('pakka::admin.default')

@section('page-header')
    {{ trans("pakka::app.invoices") }} <small>{{ trans('pakka::app.manage') }}</small>
@endsection

@section('content')

    <div class="mB-30">
        <a href="{{ route(config('pakka.prefix.admin'). '.invoices.create') }}" class="btn btn-primary-gradient">
	        <i class="ti-plus mR-10"></i>
            {{ trans('pakka::app.add_button') }}
        </a>
    </div>

	<?php
		//dd($items);
		$total = 0;
		$totalPaid = 0;
		$totalClosed = 0;
		$totalOpen = 0;

		$cTotal = 0;
		$cPaid = 0;
		$cOpen = 0;
		$cClosed = 0;

		function remove_format($number){
		    $number = floatval(str_replace(" ", "", str_replace(",", ".", $number)));
		    return $number;
		}

		foreach($items as $item){
			if($item['type'] == 1){
				switch ($item['status']) {
				    case 1:
				        $totalOpen = $totalOpen+remove_format($item['total']);
						$cOpen++;
				        break;
				    case 2:
				        $totalOpen = $totalOpen+remove_format($item['total']);
						$cOpen++;
				        break;
				    case 3:
				        $totalPaid = $totalPaid+remove_format($item['total']);
						$cPaid++;
				        break;
				    case 4:
				    	$totalClosed = $totalClosed+remove_format($item['total']);
				        $cClosed++;
				        break;
				    case 5:
				        $totalOpen = $totalOpen+remove_format($item['total']);
						$cOpen++;
				        break;
				}

				$total = $total+remove_format($item['total']);
				$cTotal++;
			}
		}

		$total = number_format($total, 2, ',', ' ');
		$totalPaid = number_format($totalPaid, 2, ',', ' ');
		$totalClosed = number_format($totalClosed, 2, ',', ' ');
		$totalOpen = number_format($totalOpen, 2, ',', ' ');
	?>

	<div class="row">
		<div class='col-md-3'>
            <div class="card-filter active layers bd bgc-white p-10 mB-30" data-value="">
                <div class="layer w-100 text-center">
                    <p class="lh-1 mB-10">{{ trans('pakka::app.total') }}<span class="pillbox">{{ $cTotal }}</span></p>
                </div>
                <div class="masonry-result layer w-100">
                    <h5>{{ $settings['invoice_valuta'] }}{{ $total }}</h5>
                </div>
            </div>
        </div>
		<div class='col-md-3'>
            <div class="card-filter layers bd bgc-white p-10 mB-30" data-value="3">
                <div class="layer w-100 text-center">
                    <p class="lh-1 mB-10">{{ trans('pakka::app.payed') }}<span class="pillbox">{{ $cPaid }}</span></p>
                </div>
                <div class="masonry-result layer w-100">
                    <h5>{{ $settings['invoice_valuta'] }}{{ $totalPaid }}</h5>
                </div>
            </div>
        </div>
        <div class='col-md-3'>
            <div class="card-filter layers bd bgc-white p-10 mB-30" data-value="1,2,5">
                <div class="layer w-100 text-center">
                    <p class="lh-1 mB-10">{{ trans('pakka::app.open') }}<span class="pillbox">{{ $cOpen }}</span></p>
                </div>
                <div class="masonry-result layer w-100">
                    <h5>{{ $settings['invoice_valuta'] }}{{ $totalOpen }}</h5>
                </div>
            </div>
        </div>
        <div class='col-md-3'>
            <div class="card-filter layers bd bgc-white p-10 mB-30" data-value="4">
                <div class="layer w-100 text-center">
                    <p class="lh-1 mB-10">{{ trans('pakka::app.closed') }}<span class="pillbox">{{ $cClosed }}</span></p>
                </div>
                <div class="masonry-result layer w-100">
                    <h5>{{ $settings['invoice_valuta'] }}{{ $totalClosed }}</h5>
                </div>
            </div>
        </div>
	</div>

    <div class="table-container table-card-filter bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-list table-striped" cellspacing="0" width="100%"> <!-- table-bordered -->
            <thead>
                <tr>
	                <th>{{ trans('pakka::app.type') }}</th>
<!--                     <th>{{ trans('pakka::app.date') }}</th> -->
                    <th>{{ trans('pakka::app.document_no') }}</th>
                    <th>{{ trans('pakka::app.name') }}</th>
                    <th style="width:125px;">{{ trans('pakka::app.total') }}</th>
                    <th>{{ trans('pakka::app.due_date') }}</th>
                    <th>{{ trans('pakka::app.status') }}</th>
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
                @foreach ($items as $item)

                	<?php
						$type = $item['type'];
						$types = config("pakka.document_type");
						$item['type'] = trans($types[$type]);
					?>

                    <tr data-value="{{ $item['status'] }}">
	                    <td>{{ $item['type'] }}</td>
<!--                         <td>{{ formatDate($item['date']) }}</td> -->

                        <td>
	                        <a href="{{ route(config('pakka.prefix.admin'). '.invoices.edit', $item['id']) }}">{{ $item['invoice_no'] }}</a>
	                    </td>

                        <td><a href="{{ route(config('pakka.prefix.admin'). '.clients.edit', $item['client_id']) }}">{{ $item['client_name'] }}</td>
                        <td>
	                        <b class="d-block" style="width: 90px;">
	                        <?php
  		                        if($item['total'] < 0){
  			                        echo str_replace ("-", "-".$settings['invoice_valuta'], formatNumber($item['total']));
  		                        }else{
  			                        echo $settings['invoice_valuta'].formatNumber($item['total']);
  		                        }
  		                    ?>
	                        </b>
	                    </td>
                        <td>{{ formatDate($item['due_date']) }}</td>
                        <td>
	                        <?php

		                        if(strtotime(date('Y-m-d H:i')) >= strtotime(formatDate($item['due_date'],'Y-m-d H:i')) && $item['status'] !== 3 && $item['status'] !== 4){
			                        $item['status'] = 5;
		                        }

		                        switch ($item['status']) {
		                            case 1:
		                                $text = trans('pakka::app.generated');
		                                $class = "";
		                                break;
		                            case 2:
		                                $text = trans('pakka::app.sent');
		                                $class = "pillbox-blue";
		                                break;
		                            case 3:
		                                $text = trans('pakka::app.payment_received');
		                                $class = "pillbox-green";
		                                break;
		                            case 4:
		                                $text = trans('pakka::app.canceled');
		                                $class = "pillbox-red";
		                                break;
		                            case 5:
		                                $text = trans('pakka::app.overdue');
		                                $class = "pillbox-orange";
		                                break;
		                        }
	                        ?>
	                        <div class="pillbox {{ $class }}">{{ $text }}</div>

	                    </td>
                        <td>
                            <ul class="list-inline" style="width:95px;">
                                <li class="list-inline-item">
                                    <a href="{{ route(config('pakka.prefix.admin'). '.invoices.edit', $item['id']) }}" title="{{ trans('pakka::app.edit_title') }}" class="btn btn-primary-gradient btn-sm"><span class="ti-pencil"></span></a></li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(config('pakka.prefix.admin'). '.invoices.destroy', $item['id']),
                                        'method' => 'DELETE',
                                        ])
                                    !!}

                                        <button class="btn btn-danger btn-sm" title="{{ trans('pakka::app.delete_title') }}"><i class="ti-trash"></i></button>

                                    {!! Form::close() !!}
                                </li>

                                <li class="list-inline-item">
                                	<span>
                                		<i class="ti-more-alt" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 35px, 0px); top: 0px; left: 0px; will-change: transform;">
	                                		<a class="dropdown-item" href="{{ route(config('pakka.prefix.admin'). '.invoices.copy', $item['id']) }}"><i class="ti-layers text-primary mR-10"></i>{{ trans('pakka::app.copy_document') }}</a>
	                                		<a class="dropdown-item" href="/view/invoice/{{ $item['id'] }}" target="_blank"><i class="ti-file text-primary mR-10"></i>{{ trans('pakka::app.view_document') }}</a>
	                                		<a class="dropdown-item" href="/download/invoice/{{ $item['id'] }}"><i class="ti-download text-primary mR-10"></i>{{ trans('pakka::app.download_document.general') }}</a>
<!-- 	                                		<a class="dropdown-item" href="#"><i class="ti-email mR-10"></i>{{ trans('pakka::app.send_to_client') }}</a> -->
<!-- 	                                		<a class="dropdown-item" href="#"><i class="ti-user mR-10"></i>{{ trans('pakka::app.view_client') }}</a></div> -->
                                	</span>
                                </li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

@endsection
