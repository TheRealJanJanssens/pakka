<?php

namespace TheRealJanJanssens\Pakka\Traits\Forms\Fieldtypes;

trait HasModelBinding
{
    public mixed $model;

    public function model(mixed $model): mixed
    {
        $this->model = $model;

        return $this;
    }
}
