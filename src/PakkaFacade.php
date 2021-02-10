<?php

namespace TheRealJanJanssens\Pakka;

use Illuminate\Support\Facades\Facade;

/**
 * @see \TheRealJanJanssens\Pakka\Pakka
 */
class PakkaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'pakka';
    }
}
