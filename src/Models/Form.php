<?php

namespace TheRealJanJanssens\Pakka\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Form extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'set_id','name','type'
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'set_id' => "required",
            
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'set_id' => 'required',
        ]);
    }
}
