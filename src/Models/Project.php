<?php

namespace TheRealJanJanssens\Pakka\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

use App\TaskGroup;
use App\Task;

class Project extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name','status','client_id','description','created_at','updated_at'
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'name'    => "required",
            
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'name'    => 'required',
        ]);
    }
}
