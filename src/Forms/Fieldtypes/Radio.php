<?php

namespace TheRealJanJanssens\Pakka\Forms\Fieldtypes;

use TheRealJanJanssens\Pakka\Traits\Forms\Fieldtypes\HasMultiple;
use TheRealJanJanssens\Pakka\Traits\Forms\Fieldtypes\HasOptions;

class Radio extends Fieldtype
{
    use HasOptions;
    use HasMultiple;

    protected string $view = 'pakka::admin.livewire.forms.framework.fieldtypes.radio';
    protected string $component = 'pakka-form-input-radio';
    protected string $classes = 'radio-fieldtype';
}
