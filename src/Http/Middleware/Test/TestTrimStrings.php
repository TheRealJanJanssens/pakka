<?php

namespace TheRealJanJanssens\Pakka\Http\Middleware\Test;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TestTrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array
     */
    protected $except = [
        'password',
        'password_confirmation',
    ];
}
