<?php

namespace TheRealJanJanssens\Pakka\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use TheRealJanJanssens\Pakka\Traits\Translations;

class MenuItem extends Model
{
    use Notifiable;
    use Translations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'menu',
        'parent',
        'position',
        'icon',
        'name',
        'link',
        'permission',
    ];

    protected $with = ['name', 'link'];

    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'link' => "required",

        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'link' => 'required',
        ]);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id', 'menu');
    }

    public function name()
    {
        return $this->hasMany(Translation::class, 'translation_id', 'name');
    }

    public function link()
    {
        return $this->hasMany(Translation::class, 'translation_id', 'link');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent');
    }

    public function scopePrimary($query)
    {
        return $query->where('parent', 0);
    }
}
