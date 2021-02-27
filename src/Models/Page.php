<?php

namespace TheRealJanJanssens\Pakka\Models;

use Cache;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\DB;
use Session;

class Page extends Model
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'position',
        'status',
        'slug',
        'name',
        'template',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
    ];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'slug' => "required",
            'name' => "required",
            'template' => "required",
            
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'slug' => "required",
            'name' => "required",
            'template' => "required",
        ]);
    }
    
    public static function getPageBySlug($slug)
    {
        $locale = app()->getLocale();
            
        $result = Page::select([
        'pages.id',
        'pages.status',
        'pages.template',
        'pages.position',
        DB::raw('(SELECT `translations`.`text` 
  				FROM `translations` 
  				WHERE `translations`.`translation_id` = `pages`.`slug` AND `translations`.`language_code` = '.$locale.') 
  				AS slug'),
            ])
        ->where('slug', $slug)
        ->get();
        
        return $result;
    }
    
    /*
    |------------------------------------------------------------------------------------
    | Get page with translations
    |
    | $id = Item id
    | $mode = construct attributes for display (1) or edit (2) purpose
    |------------------------------------------------------------------------------------
    */
    
    public static function getPage($id, $mode)
    {
        switch (true) {
            case $mode == 1:
                $locale = app()->getLocale();
            
             $result = Page::select([
                'pages.id',
                'pages.status',
                'pages.template',
                'pages.position',
                DB::raw('(SELECT `translations`.`text` 
  						FROM `translations` 
  						WHERE `translations`.`translation_id` = `pages`.`slug` AND `translations`.`language_code` = "'.$locale.'") 
  						AS slug'),
                    DB::raw('(SELECT `translations`.`text` 
  						FROM `translations` 
  						WHERE `translations`.`translation_id` = `pages`.`name` AND `translations`.`language_code` = "'.$locale.'") 
  						AS name'),
                    ])
                ->where('pages.id', $id)
                ->orderBy('pages.position');
                
                $result = Cache::tags('content')->remember('page:'.$id, 60 * 60 * 24, function () use ($result) {
                    return $result->first();
                });
                
                break;
            case $mode == 2:
                
             $queryResult = Page::select([
                'pages.id',
                'pages.status',
                'pages.template',
                'pages.position',
                DB::raw('(SELECT 
		        			GROUP_CONCAT(
		        				CASE
									WHEN `translations`.`language_code` IS NOT NULL THEN `translations`.`language_code`
									WHEN `translations`.`language_code` IS NULL THEN IFNULL(`translations`.`language_code`, "")
								END SEPARATOR "(~)"
							) 
						FROM `translations` 
						WHERE `translations`.`translation_id` = `pages`.`slug`) 
						AS language_code'),
                DB::raw('(SELECT 
		        			GROUP_CONCAT(
		        				CASE
									WHEN `translations`.`text` IS NOT NULL THEN `translations`.`text`
									WHEN `translations`.`text` IS NULL THEN IFNULL(`translations`.`text`, "")
								END SEPARATOR "(~)"
							) 
						FROM `translations` 
						WHERE `translations`.`translation_id` = `pages`.`slug`) 
						AS slug'),
                    DB::raw('(SELECT 
    		        			GROUP_CONCAT(
    		        				CASE
    									WHEN `translations`.`text` IS NOT NULL THEN `translations`.`text`
    									WHEN `translations`.`text` IS NULL THEN IFNULL(`translations`.`text`, "")
    								END SEPARATOR "(~)"
    							) 
    						FROM `translations` 
    						WHERE `translations`.`translation_id` = `pages`.`name`) 
    						AS name'),
            DB::raw('`pages`.`slug` AS slug_trans'),
            DB::raw('`pages`.`name` AS name_trans'),
                ])
                ->where('pages.id', $id)
                ->orderBy('pages.position')
                ->get();
                
          $result = constructTranslatableValues($queryResult, ['slug','name']);

          break;
        }
        
        return $result; //outputs array
    }
    
    /*
    |------------------------------------------------------------------------------------
    | Get pages with translations
    |
    | $mode = construct attributes for display (1) or edit (2) purpose
    |------------------------------------------------------------------------------------
    */
    
    public static function getPages($mode = 1)
    {
        $locale = app()->getLocale();
        
        switch ($mode) {
            case 1:
              $result = Page::select([
            'pages.id',
                'pages.status',
                DB::raw(' (SELECT `translations`.`text` FROM `translations` WHERE `translations`.`translation_id` = `pages`.`slug` AND `translations`.`language_code` = "'.$locale.'") AS slug'),
                'pages.template',
                DB::raw(' (SELECT `translations`.`text` FROM `translations` WHERE `translations`.`translation_id` = `pages`.`name` AND `translations`.`language_code` = "'.$locale.'") AS name'),
                'pages.name AS trans_name',
                'pages.slug as link',
                ])
                ->orderBy('pages.position')
                ->get();

              break;
            case 2:
                $langs = Language::all(); //Session::get('lang') session not accesable in route sessionstart happens after route
                $result = [];
                
            foreach ($langs as $lang) {
                $locale = $lang->language_code;
                
                $resultPages = Page::select([
              'pages.id',
                    'pages.status',
                    DB::raw(' (SELECT `translations`.`text` FROM `translations` WHERE `translations`.`translation_id` = `pages`.`slug` AND `translations`.`language_code` = "'.$locale.'") AS slug'),
                    'pages.template',
                    DB::raw(' (SELECT `translations`.`text` FROM `translations` WHERE `translations`.`translation_id` = `pages`.`name` AND `translations`.`language_code` = "'.$locale.'") AS name'),
                    'pages.name AS trans_name',
                    'pages.slug as link',
                    ])
                    ->orderBy('pages.position')
                    ->get();

                foreach ($resultPages as $p) {
                    array_push($result, $p);
                }
            }

            break;
        }

        return $result;
    }
    
    /*
    |------------------------------------------------------------------------------------
    | Gets all the pages in a link array
    |
    | This is used in the menu module to display the pages in the create and update menuitem views
    | The slug is can be translated with setting trans = true
    | Outputs [slug => name ,...]
    |------------------------------------------------------------------------------------
    */
    
    public static function getPagesLinks($trans = false)
    {
        $locale = app()->getLocale();
        
        if ($trans == true) {
            $pages = Page::select([
            DB::raw(' (SELECT `translations`.`text` FROM `translations` WHERE `translations`.`translation_id` = `pages`.`name` AND `translations`.`language_code` = "'.$locale.'") AS name'),
            '(SELECT `translations`.`text` FROM `translations` WHERE `translations`.`translation_id` = `pages`.`slug` AND `translations`.`language_code` = "'.$locale.'") as slug',
            ])
            ->orderBy('pages.position')
            ->get();
        } else {
            $pages = Page::select([
            DB::raw(' (SELECT `translations`.`text` FROM `translations` WHERE `translations`.`translation_id` = `pages`.`name` AND `translations`.`language_code` = "'.$locale.'") AS name'),
            'pages.slug as slug',
            ])
            ->orderBy('pages.position')
            ->get();
        }
        
        if (! empty($pages)) {
            foreach ($pages as $page) {
                $result[$page->slug] = $page->name;
            }
        } else {
            $result = [];
        }
        
        return $result;
    }
}
