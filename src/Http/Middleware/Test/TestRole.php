<?php

namespace TheRealJanJanssens\Pakka\Http\Middleware\Test;

use Auth;
use Closure;

class TestRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Not Logged
        if (! Auth::check()) {
            return redirect('/login');
        }

        // Not allowed
        if ($request->user()->role < $role) {
            return abort(404);
        }

        return $next($request);
    }
}
