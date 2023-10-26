<?php

namespace TheRealJanJanssens\Pakka\View\Forms;

use Illuminate\View\Component;
use Illuminate\View\View;

class Fieldtype extends Component
{
    /**
     * Create the component instance.
     */
    public function __construct(
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('pakka::admin.partials.forms.fieldtype');
    }
}
