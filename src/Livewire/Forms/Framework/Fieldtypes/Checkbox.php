<?php

namespace TheRealJanJanssens\Pakka\Livewire\Forms\Framework\Fieldtypes;

use Livewire\Component;
use TheRealJanJanssens\Pakka\Forms\Fieldtypes\Check as Input;
use TheRealJanJanssens\Pakka\Traits\Livewire\HasValue;
use Livewire\Attributes\Reactive;

class Checkbox extends Component
{
    use HasValue;

    #[Reactive]
    public Input $object;

    public function mount()
    {
        $this->value = $this->defaultValue[$this->object->getName()] ?? [];
    }

    public function render()
    {
        return view($this->object->getView());
    }
}
