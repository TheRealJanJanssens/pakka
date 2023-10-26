<?php

namespace TheRealJanJanssens\Pakka\Traits\Forms\Layout;

trait HasDescription
{
    protected string $description;

    public function description(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function hasDescription(): bool
    {
        return ! empty($this->description);
    }
}
