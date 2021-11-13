<?php

namespace TheRealJanJanssens\Pakka\Http\Middleware\Test;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;

class TestCheckForMaintenanceMode extends Middleware
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array
     */
    protected $except = [
        //
    ];
}
