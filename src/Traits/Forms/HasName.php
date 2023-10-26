<?php

namespace TheRealJanJanssens\Pakka\Traits\Forms;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

trait HasName
{
    protected string $name;

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLabelFromName(): string | Htmlable | null
    {
        $label = (string) Str::of($this->getName())
            ->afterLast('.')
            ->kebab()
            ->replace(['-', '_'], ' ')
            ->ucfirst();

        return $label;

        // return (is_string($label) && $this->shouldTranslateLabel) ?
        //     __($label) :
        //     $label;
    }
}
