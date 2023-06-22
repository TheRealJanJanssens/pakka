<?php

namespace TheRealJanJanssens\Pakka\Traits\Forms;

use App\Enums\CustomInputAttribute;

trait HasCustomAttributes
{
    public function getStyle($key){

        CustomInputAttribute::{$key};
        return ['class' =>   ];
    }
}
