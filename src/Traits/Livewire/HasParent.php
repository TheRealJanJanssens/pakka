<?php

namespace TheRealJanJanssens\Pakka\Traits\Livewire;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

trait HasParent
{
    public array $parent;

    public function getParent(): array
    {
        return $this->parent;
    }
}
