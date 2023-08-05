<?php

namespace TheRealJanJanssens\Pakka\View\Forms;

use Illuminate\View\Component;
use Illuminate\View\View;
use TheRealJanJanssens\Pakka\Forms\FormBuilder;

class Index extends Component
{
    //public string $route;

    public function __construct(
        public FormBuilder $form
    ) {
    }

    public function render(): View
    {
        return view('pakka::admin.partials.forms.index');
    }
}
