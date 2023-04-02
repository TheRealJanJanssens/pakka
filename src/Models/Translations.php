<?php

namespace TheRealJanJanssens\Pakka\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Translations extends Model
{
    protected $guarded = [];

    //Wildcard method which works
    // public function __call($method,$args) {
    //     return $this->{$method};
    // }

    public function setAttribute($key, $value)
    {
        $locale = app()->getLocale();
        $translation = collect($value);
        $result = $translation->where('language_code', $locale)->first();

        return parent::setAttribute($key, $result->value() ?? $translation->first()->value());
    }




    // Below functions are broken and redundant?

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

        return collect($this->attributes)->first(function ($item) use ($locale) {
            return $item->language_code == $locale;
        });
    }
}
