<?php

namespace TheRealJanJanssens\Pakka\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language_code','name'
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
    
    public static function getLangCodes(){
	    $langs = Language::select(['languages.language_code'])->get()->toArray();
		    
	    $i=0;
	    foreach($langs as $lang){
		    $result[$i] = $lang['language_code'];
		    $i++;
	    }
	    
	    return $result;
    }
}
