<?php

namespace TheRealJanJanssens\Pakka\Forms\Fieldtypes;

use Closure;
use TheRealJanJanssens\Pakka\Forms\Input;
use TheRealJanJanssens\Pakka\Traits\Forms\HasOptions;

class Select extends Input
{
    use HasOptions;

    protected string $view = 'pakka::forms.fieldtypes.select';
}
