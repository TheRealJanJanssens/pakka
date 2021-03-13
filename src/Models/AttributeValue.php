<?php

namespace TheRealJanJanssens\Pakka\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AttributeValue extends Model
{
    use Notifiable;
    
    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'input_id',
        'item_id',
        'language_code',
        'option_id',
        'value',
    ];
    
    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'input_id' => "required",
            'item_id' => "required",
            
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'input_id' => "required",
            'item_id' => "required",
        ]);
    }
}
