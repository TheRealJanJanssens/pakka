<?php

namespace TheRealJanJanssens\Pakka\Livewire\Forms\Framework\Fieldtypes;

use Livewire\Attributes\Reactive;
use Livewire\Component;
use TheRealJanJanssens\Pakka\Forms\Fieldtypes\Radio as Input;
use TheRealJanJanssens\Pakka\Traits\Livewire\HasValue;

class Radio extends Component
{
    use HasValue;

    #[Reactive]
    public Input $object;

    public function render()
    {
        return view($this->object->getView());
    }
}
