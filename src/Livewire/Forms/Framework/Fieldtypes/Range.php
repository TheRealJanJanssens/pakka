<?php

namespace TheRealJanJanssens\Pakka\Livewire\Forms\Framework\Fieldtypes;

use Livewire\Component;
use TheRealJanJanssens\Pakka\Forms\Fieldtypes\Range as Input;
use TheRealJanJanssens\Pakka\Traits\Livewire\HasValue;
use Livewire\Attributes\Reactive;

class Range extends Component
{
    use HasValue;

    #[Reactive]
    public Input $object;

    public function mount()
    {
        $this->value = $this->defaultValue[$this->object->getName()] ?? ($this->object->getMax() - $this->object->getMin())/2;
    }

    public function render()
    {
        return view($this->object->getView());
    }
}
