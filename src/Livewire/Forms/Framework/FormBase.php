<?php

namespace TheRealJanJanssens\Pakka\Livewire\Forms\Framework;

use Livewire\Attributes\On;
use Livewire\Component;
use TheRealJanJanssens\Pakka\Events\OnFormSubmitted;
use TheRealJanJanssens\Pakka\Forms\Layout\Step;

class FormBase extends Component
{
    public $result;
    public string $name;

    public int $currentStep;
    public array $meta;
    public bool $hasConclusion = false;

    public function mount()
    {
        //$this->dispatch('js-get-localstorage', $this->name);
        $this->currentStep = 0;
    }

    public function getMeta()
    {
        return [
            'step' => [
                'current' => $this->currentStep,
                'count' => $this->countSteps(),
                'hasConclusion' => $this->hasConclusion,
                'hasReactiveSteps' => $this->hasReactiveSteps(),
            ],
        ];
    }

    public function hasSteps(): bool
    {
        foreach ($this->schema() as $obj) {
            if ($obj instanceof Step) {
                return true;
            }
        }

        return false;
    }

    public function hasReactiveSteps(): bool
    {
        foreach ($this->schema() as $obj) {
            if ($obj instanceof Step) {
                if ($obj->isReactive()) {
                    return true;
                }
            }
        }

        return false;
    }

    public function countSteps()
    {
        $i = 0;

        foreach ($this->schema() as $obj) {
            if ($obj instanceof Step) {
                $i++;
            }
        }

        return $i;
    }

    /**
     * Filters reactive steps if they don't meet the conditions
     */
    public function filteredSchema(): array
    {
        return array_values(array_filter($this->schema(), function ($obj) {
            if ($obj instanceof Step) {
                if ($obj->getReactive() || ! $obj->isReactive()) {
                    return $obj instanceof Step;
                }
            }
        }));
    }

    #[On('next-step')]
    public function nextStep()
    {
        //$this->dispatch('js-set-localstorage', $this->name, $this->result);
        $this->currentStep++;
    }

    #[On('previous-step')]
    public function previousStep()
    {
        //$this->dispatch('js-set-localstorage', $this->name, $this->result);
        $this->currentStep--;
    }

    #[On('get-localstorage')]
    public function updateResultsFromLocalStorage($content)
    {
        $this->result = $content;
    }

    #[On('input-updated')]
    public function updateResults($name, $value)
    {
        $this->result[$name] = $value;
    }

    public function saveForm(): void
    {
        OnFormSubmitted::dispatch($this->result);
    }

    public function render()
    {
        return view('pakka::admin.livewire.forms.framework.form-base');
    }
}
