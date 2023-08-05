<?php

namespace TheRealJanJanssens\Pakka\View\Forms\FieldTypes;

use Illuminate\View\Component;
use Illuminate\View\View;
use TheRealJanJanssens\Pakka\Forms\Fieldtypes\TextInput as Input;

class TextInput extends Component
{
    //public string $route;

    public function __construct(
        public Input $field
    ) {
    }

    public function render(): View
    {
        return view('pakka::admin.partials.forms.fieldtypes.text-input');
    }
}
