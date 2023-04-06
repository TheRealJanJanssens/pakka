<?php

namespace TheRealJanJanssens\Pakka\Traits;

use TheRealJanJanssens\Pakka\Models\Translation;
use TheRealJanJanssens\Pakka\Models\Translations as Collection;

trait Translations
{
    /**
     * Convert translation relationships in a Translations instance
     *
     * @return Translations
     */
    public function translations()
    {
        $result = collect($this->getRelations())->filter(function ($relation) {
            return $relation->first() instanceof Translation;
        })->mapWithKeys(function ($value, $key) {
            return [$value->first()->input_name => $value->all()]; //new Collection($value->all())
        })->all();

        return new Collection($result);
    }

    public function localize()
    {
        $this->attributes = array_merge($this->attributes, $this->translations()->attributes);

        return $this;
    }
}
