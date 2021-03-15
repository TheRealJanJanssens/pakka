<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers\Auth;

use Session;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use TheRealJanJanssens\Pakka\Http\Controllers\Controller;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('pakka::auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        //This is getting used as a fallback on the empty Auth::user() in helpers.php
        Session::put('auth.id', $user->id);
        Session::put('auth.email', $user->email);
        Session::put('auth.role', $user->role);
    }
}
