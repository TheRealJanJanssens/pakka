<?php

namespace TheRealJanJanssens\Pakka\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Translations extends Model
{
    protected $guarded = [];

    //Wildcard method which works
    // public function __call($method,$args) {
    //     return $this->{$method};
    // }

    //Works but misses embeded functions
    // protected function name(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($value) => $this->translations()->name->value()
    //     );
    // }

    // protected function castAttribute($key, $value) {
    //     if (is_null($value)) {
    //         return $value;
    //     }

    //     dd("in castable");

    //     return parent::castAttribute($key, $value);
    // }

    public function setAttribute($key, $value)
    {
        $locale = app()->getLocale();
        $translation = collect($value);
        $result = $translation->where('language_code', $locale)->first();
        return parent::setAttribute($key, $result->text ?? $translation->first()->text);
    }

    /**
     * Directly get the translated value with current locale
     *
     * @return string
     */
    public function value()
    {
        return $this->locale()->value();
    }

    /**
     * Select a specific Translation
     *
     * @param null $locale
     *
     * @return Translation
     */
    public function locale($locale = null)
    {
        $locale = $locale ?? app()->getLocale();
        return collect($this->attributes)->first(function($item) use ($locale) {
            return $item->language_code == $locale;
        });
    }
}
