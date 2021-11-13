<?php

namespace TheRealJanJanssens\Pakka\Http\Middleware\Test;

use App;
use Closure;
use Config;
use Session;

class TestLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = Session::get('locale', Config::get('app.locale'));
        App::setLocale($locale);

        return $next($request);
    }
}
