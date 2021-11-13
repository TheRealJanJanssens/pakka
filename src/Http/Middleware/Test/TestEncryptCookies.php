<?php

namespace TheRealJanJanssens\Pakka\Http\Middleware\Test;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class TestEncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        'laravel_session',
    ];
}
