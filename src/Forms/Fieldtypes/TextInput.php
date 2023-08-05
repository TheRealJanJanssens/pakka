<?php

namespace TheRealJanJanssens\Pakka\Forms\Fieldtypes;

use Closure;
use TheRealJanJanssens\Pakka\Forms\Input;

class TextInput extends Input
{
    protected string $view = 'pakka::forms.fieldtypes.text-input';

    protected string | Closure | null $type = null;
    protected bool | Closure $isEmail = false;
    protected bool | Closure $isNumeric = false;
    protected bool | Closure $isPassword = false;
    protected bool | Closure $isTel = false;
    protected bool | Closure $isUrl = false;

    public function type($type)
    {
        $this->type = $type;

        return $this;
    }

    public function email(bool | Closure $condition = true): static
    {
        $this->isEmail = $condition;

        return $this;
    }

    public function integer(bool | Closure $condition = true): static
    {
        $this->isNumeric = $condition;

        return $this;
    }

    public function password(bool | Closure $condition = true): static
    {
        $this->isPassword = $condition;

        return $this;
    }

    public function tel(bool | Closure $condition = true): static
    {
        $this->isTel = $condition;

        return $this;
    }

    public function url(bool | Closure $condition = true): static
    {
        $this->isUrl = $condition;

        return $this;
    }

    public function isEmail(): bool
    {
        return (bool) $this->isEmail;
    }

    public function isNumeric(): bool
    {
        return (bool) $this->isEmail;
    }

    public function isPassword(): bool
    {
        return (bool) $this->isEmail;
    }

    public function isTel(): bool
    {
        return (bool) $this->isEmail;
    }

    public function isUrl(): bool
    {
        return (bool) $this->isEmail;
    }

    public function getType(): string
    {
        if ($type = $this->evaluate($this->type)) {
            return $type;
        } elseif ($this->isEmail()) {
            return 'email';
        } elseif ($this->isNumeric()) {
            return 'number';
        } elseif ($this->isPassword()) {
            return 'password';
        } elseif ($this->isTel()) {
            return 'tel';
        } elseif ($this->isUrl()) {
            return 'url';
        }

        return 'text';
    }
}
