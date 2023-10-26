<?php

namespace TheRealJanJanssens\Pakka\Forms\Layout;

use Livewire\Wireable;
use TheRealJanJanssens\Pakka\Traits\EvaluatesClosures;
use TheRealJanJanssens\Pakka\Traits\Forms\HasView;
use TheRealJanJanssens\Pakka\Traits\Forms\HasWireables;
use TheRealJanJanssens\Pakka\Traits\Forms\IsReactive;
use TheRealJanJanssens\Pakka\Traits\Forms\Layout\HasDescription;
use TheRealJanJanssens\Pakka\Traits\Forms\Layout\HasSchema;
use TheRealJanJanssens\Pakka\Traits\Forms\Layout\HasTitle;

class Step implements Wireable
{
    use HasView;
    use HasTitle;
    use HasSchema;
    use HasWireables;
    use HasDescription;
    use IsReactive;
    use EvaluatesClosures;

    protected string $view = 'pakka::admin.livewire.forms.framework.layout.step';
    protected string $component = 'pakka-form-step';

    public function __construct(array $schema)
    {
        $this->schema($schema);
        $this->setConstructAttributeKey('schema');
    }

    public static function make(array $schema)
    {
        $form = new static($schema);

        return $form;
    }

    public function getView(): string
    {
        return $this->view;
    }
}
