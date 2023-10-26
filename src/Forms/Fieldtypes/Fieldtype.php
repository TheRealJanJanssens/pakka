<?php

namespace TheRealJanJanssens\Pakka\Forms\Fieldtypes;

use TheRealJanJanssens\Pakka\Traits\EvaluatesClosures;
use TheRealJanJanssens\Pakka\Traits\Forms\HasName;
use TheRealJanJanssens\Pakka\Traits\Forms\Fieldtypes\HasLabel;
use TheRealJanJanssens\Pakka\Traits\Forms\Fieldtypes\HasRequired;
use TheRealJanJanssens\Pakka\Traits\Forms\IsReactive;
use TheRealJanJanssens\Pakka\Traits\Forms\HasWireables;
use Livewire\Wireable;
use TheRealJanJanssens\Pakka\Traits\Forms\HasView;

class Fieldtype implements Wireable
{
    use HasName;
    use HasView;
    use HasLabel;
    use IsReactive;
    use HasRequired;
    use HasWireables;
    use EvaluatesClosures;

    protected string $view = 'field';
    protected string $classes = 'field';
    protected string $component = 'field';

    public function __construct(string $name)
    {
        $this->name($name);
        $this->setConstructAttributeKey('name');
    }

    public static function make(string $name)
    {
        $form = new static($name);

        return $form;
    }

    public function getClasses(): string
    {
        return $this->classes;
    }
}
