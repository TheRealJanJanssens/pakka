<?php

namespace TheRealJanJanssens\Pakka\Livewire\Forms\Framework\Fieldtypes;

use Livewire\Component;
use TheRealJanJanssens\Pakka\Forms\Fieldtypes\Select as Input;
use TheRealJanJanssens\Pakka\Traits\Livewire\HasValue;
use Livewire\Attributes\Reactive;

class Select extends Component
{
    use HasValue;

    #[Reactive]
    public Input $object;

    public function render()
    {
        return view($this->object->getView());
    }
}
