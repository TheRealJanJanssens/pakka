<?php

namespace TheRealJanJanssens\Pakka\Livewire\Forms\Framework\Fieldtypes;

use App\Traits\Livewire\HasValue;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use TheRealJanJanssens\Pakka\Forms\Fieldtypes\Text as Input;

class Text extends Component
{
    use HasValue;

    #[Reactive]
    public Input $object;

    public function render()
    {
        return view($this->object->getView());
    }
}
