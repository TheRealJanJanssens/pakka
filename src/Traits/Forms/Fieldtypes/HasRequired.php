<?php

namespace TheRealJanJanssens\Pakka\Traits\Forms\Fieldtypes;

trait HasRequired
{
    protected bool $required;

    public function required(bool $required = true): static
    {
        $this->required = $required;

        return $this;
    }

    public function isRequired(): bool
    {
        return $this->required ?? false;
    }
}
