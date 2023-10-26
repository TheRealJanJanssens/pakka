<?php

namespace TheRealJanJanssens\Pakka\Traits\Forms\Layout;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

trait HasSchema
{
    protected array $schema;

    public function schema(array $schema): static
    {
        $this->schema = $schema;

        return $this;
    }

    public function getSchema(): array
    {
        return $this->schema;
    }
}
