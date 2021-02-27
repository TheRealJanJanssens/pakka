<?php

namespace TheRealJanJanssens\Pakka\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model
{
    use Notifiable;
	
	public $timestamps = false;
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'payment_id', 'provider', 'amount', 'method'
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'order_id'    => "required",
            'payment_id'    => "required"
            
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'order_id'    => "required",
            'payment_id'    => "required"
        ]);
    }
    
    /*
    |------------------------------------------------------------------------------------
    | Get Documents
    |
    | $id = order id
    |------------------------------------------------------------------------------------
    */
    
    public static function getPayment($id)
    {
	    $result = OrderPayment::select([
        'order_payments.id',
        'order_payments.order_id',
        'order_payments.payment_id',
        'order_payments.provider',
        'order_payments.amount',
        'order_payments.method'])
	  	->where('order_payments.order_id', $id)
	    ->get();
	    
	    if(isset($result[0])){
		    return $result[0]->toArray();
	    }
    }
}
