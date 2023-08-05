<?php

namespace TheRealJanJanssens\Pakka\Forms;

use TheRealJanJanssens\Pakka\Traits\Forms\HasModelBinding;

class FormBuilder
{
    use HasModelBinding;

    public array $fields;

    public function __construct(array $fields = [])
    {
        $this->fields($fields);
    }

    public static function make(array $arguments)
    {
        $form = new static($arguments);

        return $form;
    }

    public function fields($fields)
    {
        $this->fields = $fields;

        return $this;
    }
}
