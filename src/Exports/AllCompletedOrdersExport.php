<?php

namespace TheRealJanJanssens\Pakka\Exports;

use TheRealJanJanssens\Pakka\Models\Order;
use TheRealJanJanssens\Pakka\Models\OrderDocument;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllCompletedOrdersExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            trans('pakka::app.order_no'), 
            trans('pakka::app.firstname'), 
            trans('pakka::app.lastname'), 
            trans('pakka::app.address'),
            trans('pakka::app.city'),  
            trans('pakka::app.zip'), 
            trans('pakka::app.country'),
            trans('pakka::app.email'),  
            trans('pakka::app.total'),
            trans('pakka::app.invoice_no') 
        ];
    }

    public function collection()
    {
        $orders = Order::getCompletedOrders();
        
        $result = $orders->map(function($item) {
            $documents = OrderDocument::getDocuments($item->id);
            
            if(!$documents->isEmpty()){
                $item['invoice_no']=$documents->last()->invoice_no;
            }

            return collect($item)->only(['order_id','firstname','lastname','address','city','zip','country','email','total','invoice_no']);
        });

        return $result;
    }
}
