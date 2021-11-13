<?php

namespace TheRealJanJanssens\Pakka\Http\Middleware\Test;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class TestVerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'cart/webhook/mollie',
    ];
}
