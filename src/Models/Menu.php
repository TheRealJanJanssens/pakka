<?php

namespace TheRealJanJanssens\Pakka\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

use Session;
use Cache;

class Menu extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name'
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
    
    /*
    |------------------------------------------------------------------------------------
    | Gets all the menus in a link array
    |
    | This is used in the layout editor to display the menus in the select menus options
    | Outputs [id => name ,...]
    |------------------------------------------------------------------------------------
    */
    
    public static function getMenuLinks(){
	    $pages = Menu::select([
        	'menus.id',
	        'menus.name',
	  	])
	  	->orderBy('menus.id')
	    ->get()->toArray();
        
	    if(!empty($pages)){
		    foreach($pages as $page){
			    $result[$page["id"]] = $page['name'];
		    } 
	    }else{
		    $result = array();
	    }
	    
	    return $result;
    }
    
    public static function getMenuOrFirst($id = null){
	    if(empty($id)){
		    $query = Cache::remember('menus.first-menu', 60*60*24, function(){
		        return Menu::select('menus.id')->where('id', '!=', 1)->first();
	        });
	        $id = $query->id;
	    }else{
		    $id;
	    }

	    return Session::get('menus')[$id];
    }
}
