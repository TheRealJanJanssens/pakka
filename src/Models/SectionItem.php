<?php

namespace TheRealJanJanssens\Pakka\Models;

use Illuminate\Support\Facades\DB;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class SectionItem extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'section',
        'name',
        'tags'
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'section'    => "required",
            
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'section'    => "required",
        ]);
    }
    
    /*
    |------------------------------------------------------------------------------------
    | Get sections by type
    |
    | $type
    |------------------------------------------------------------------------------------
    */
    
    public static function getSectionItemsByType($type){
	    
	    $result = SectionItem::select([
        'section_items.id',
        'section_items.name',
        'section_items.section',
        'section_items.tags',
    	])
	    ->where('section_items.type', $type)
	    ->orderBy('name')
	    ->get();
	    
	    return $result;
	}
}
