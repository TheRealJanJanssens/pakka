<?php

namespace TheRealJanJanssens\Pakka\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use Notifiable;
	
	public $timestamps = false;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id', 'name', 'price', 'quantity', 'vat', 'position'
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'invoice_id'    => "required"
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'invoice_id'    => "required"
        ]);
    }

    
}
