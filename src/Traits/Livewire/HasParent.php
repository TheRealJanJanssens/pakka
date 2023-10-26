<?php

namespace TheRealJanJanssens\Pakka\Traits\Livewire;

trait HasParent
{
    public array $parent;

    public function getParent(): array
    {
        return $this->parent;
    }
}
