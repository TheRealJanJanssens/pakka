<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

//use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use TheRealJanJanssens\Pakka\Exports\AllCompletedOrdersExport;
use TheRealJanJanssens\Pakka\Exports\AllInvoicesExport;
use TheRealJanJanssens\Pakka\Exports\AllOrdersExport;

class ExportController extends Controller
{
    public function allOrders()
    {
        return Excel::download(new AllOrdersExport(), 'all_orders-'.date('Ymd').'.xlsx');
    }

    public function allCompletedOrders()
    {
        return Excel::download(new AllCompletedOrdersExport(), 'all_completed_orders-'.date('Ymd').'.xlsx');
    }

    public function allInvoices()
    {
        return Excel::download(new AllInvoicesExport(), 'all_invoices-'.date('Ymd').'.xlsx');
    }
}
