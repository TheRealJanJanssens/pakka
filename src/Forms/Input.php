<?php

namespace TheRealJanJanssens\Pakka\Forms;

use TheRealJanJanssens\Pakka\Traits\EvaluatesClosures;

class Input
{
    use EvaluatesClosures;

    public string $name;
    protected string $view = 'field';

    public function __construct(string $name)
    {
        $this->name($name);
    }

    public static function make(string $name)
    {
        $form = new static($name);

        return $form;
    }

    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getField(): string
    {
        return $this->view;
    }
}
