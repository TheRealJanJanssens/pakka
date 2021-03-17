<?php

namespace TheRealJanJanssens\Pakka\Providers;

use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach (glob(__DIR__."/../Macros/*.php") as $filename) {
            require_once($filename);
        }
    }
}
