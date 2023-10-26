<?php

namespace TheRealJanJanssens\Pakka\Traits\Forms\Layout;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

trait HasTitle
{
    protected string $title;

    public function title(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function hasTitle(): bool
    {
        return !empty($this->title);
    }
}
