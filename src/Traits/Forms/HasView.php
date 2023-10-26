<?php

namespace TheRealJanJanssens\Pakka\Traits\Forms;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

trait HasView
{
    // protected string $view;
    // protected string $component;

    public function getView(): string
    {
        return $this->view;
    }

    public function getComponent(): string
    {
        return $this->component;
    }
}
