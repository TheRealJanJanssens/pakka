<?php

namespace TheRealJanJanssens\Pakka\Traits\Forms\Fieldtypes;

use Closure;

trait HasMultiple
{
    protected bool | Closure $isMultiple = false;

    public function multiple(bool | Closure $condition = true): static
    {
        $this->isMultiple = $condition;

        return $this;
    }

    public function isMultiple(): bool
    {
        return $this->evaluate($this->isMultiple);
    }
}
