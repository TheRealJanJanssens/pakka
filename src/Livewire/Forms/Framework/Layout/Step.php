<?php

namespace TheRealJanJanssens\Pakka\Livewire\Forms\Framework\Layout;

use Livewire\Attributes\Reactive;
use Livewire\Component;
use TheRealJanJanssens\Pakka\Forms\Layout\Step as Layout;
use TheRealJanJanssens\Pakka\Traits\Livewire\HasParent;

class Step extends Component
{
    use HasParent;

    #[Reactive]
    public $result;
    public Layout $object;

    public function getCurrentStep()
    {
        return $this->parent['step']['current'] + 1;
    }

    public function getCountSteps()
    {
        return $this->parent['step']['count'];
    }

    public function hasConclusion(): bool
    {
        return $this->parent['step']['hasConclusion'];
    }

    public function hasReactiveSteps(): bool
    {
        return $this->parent['step']['hasReactiveSteps'];
    }

    public function nextStep()
    {
        //TODO: first validate values before dispatching
        $this->dispatch('next-step');
    }

    public function previousStep()
    {
        //TODO: first validate values before dispatching
        $this->dispatch('previous-step');
    }

    public function render()
    {
        return view($this->object->getView());
    }
}
