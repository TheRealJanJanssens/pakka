<?php

namespace TheRealJanJanssens\Pakka\Traits\Forms;

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
