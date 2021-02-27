<?php

namespace TheRealJanJanssens\Pakka\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use Notifiable;
	
	public $timestamps = false;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'order_id', 'sku', 'name', 'price', 'quantity', 'weight', 'vat'
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'order_id'    => "required"
            
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'order_id'    => "required"
        ]);
    }
}
