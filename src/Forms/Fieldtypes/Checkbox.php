<?php

namespace TheRealJanJanssens\Pakka\Forms\Fieldtypes;

use TheRealJanJanssens\Pakka\Traits\Forms\Fieldtypes\HasMultiple;
use TheRealJanJanssens\Pakka\Traits\Forms\Fieldtypes\HasOptions;

class Checkbox extends Fieldtype
{
    use HasOptions;
    use HasMultiple;

    protected string $view = 'pakka::admin.livewire.forms.framework.fieldtypes.checkbox';
    protected string $component = 'pakka-form-input-checkbox';
    protected string $classes = 'check-fieldtype';
}
