<?php

namespace TheRealJanJanssens\Pakka\Traits\Livewire;

use Livewire\Attributes\On;

trait HasValue
{
    public mixed $value;

    public mixed $defaultValue;

    public function mount()
    {
        $this->value = $this->defaultValue[$this->object->getName()] ?? null;
    }

    public function updatedValue()
    {
        $this->dispatch(
            'input-updated',
            name: $this->object->getName(),
            value: $this->value
        );
    }

    // Hacking in defaultValues from localStorage
    // Wasn't able to do this with #[Reactive]
    // The data stopped at fieldtype.blade.php because fieldtypes weren't refreshed.
    // This is a workaround.
    #[On('get-localstorage')]
    public function updateResultsFromLocalStorage($content)
    {
        $this->defaultValue = $content;
        $this->mount();
    }
}
