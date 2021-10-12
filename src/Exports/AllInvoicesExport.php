<?php

namespace TheRealJanJanssens\Pakka\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use TheRealJanJanssens\Pakka\Models\Invoice;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllInvoicesExport implements FromArray, WithHeadings
{
    public function headings(): array
    {
        return [
            trans('pakka::app.invoice_no'), 
            trans('pakka::app.date'), 
            trans('pakka::app.due_date'),
            trans('pakka::app.name'),
            trans('pakka::app.address'),
            trans('pakka::app.city'),  
            trans('pakka::app.zip'), 
            trans('pakka::app.country'),
            trans('pakka::app.vat'),
            trans('pakka::app.email'),  
            trans('pakka::app.phone'),
            trans('pakka::app.subtotal'),
            trans('pakka::app.vat_short'),
            trans('pakka::app.total')
        ];
    }

    public function array(): array
    {
        $invoices = Invoice::getInvoices(1);

        $i=0;
        foreach($invoices as $invoice){
            unset($invoice['id']);
            unset($invoice['status']);
            unset($invoice['type']);
            unset($invoice['client_id']);
            unset($invoice['description']);
            unset($invoice['ship_name']);
            unset($invoice['ship_address']);
            unset($invoice['ship_city']);
            unset($invoice['ship_zip']);
            unset($invoice['ship_country']);
            unset($invoice['items']);
            $result[$i] = $invoice;
            $i++;
        }

        // $result = $invoices->map(function($item) {
        //     return collect($item)->only(['invoice_no','status','date','due_date','client_name','client_address','client_city','client_zip','client_country','client_vat','client_email','client_phone']);
        // });

        return $result;
    }
}
