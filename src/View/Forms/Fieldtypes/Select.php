<?php

namespace TheRealJanJanssens\Pakka\View\Forms\FieldTypes;

use Illuminate\View\Component;
use Illuminate\View\View;
use TheRealJanJanssens\Pakka\Forms\Fieldtypes\Select as Input;

class Select extends Component
{
    public function __construct(
        public Input $field
    ) {
    }

    public function render(): View
    {
        return view('pakka::admin.partials.forms.fieldtypes.select');
    }
}
