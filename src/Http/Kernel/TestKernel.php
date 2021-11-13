<?php

namespace TheRealJanJanssens\Pakka\Http\Kernel;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class TestKernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \TheRealJanJanssens\Pakka\Http\Middleware\Test\TestTrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \TheRealJanJanssens\Pakka\Http\Middleware\Test\TestCheckForMaintenanceMode::class,
        \TheRealJanJanssens\Pakka\Http\Middleware\Test\TestPreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \TheRealJanJanssens\Pakka\Http\Middleware\Test\TestTrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \TheRealJanJanssens\Pakka\Http\Middleware\Test\TestEncryptCookies::class,
        \Illuminate\Session\Middleware\StartSession::class, //only a fix bc it needs to be called in middleware group web
        \Illuminate\View\Middleware\ShareErrorsFromSession::class, //only a fix bc it needs to be called in middleware group web
        //\Spatie\Honeypot\ProtectAgainstSpam::class, //adds honeypot
        //\Spatie\CookieConsent\CookieConsentMiddleware::class, //adds cookie consent
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            //\App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            //\Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            //\Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \TheRealJanJanssens\Pakka\Http\Middleware\Test\TestVerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            'throttle:api',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \TheRealJanJanssens\Pakka\Http\Middleware\Test\TestAuthenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \TheRealJanJanssens\Pakka\Http\Middleware\Test\TestRedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'Role' => \TheRealJanJanssens\Pakka\Http\Middleware\Test\TestRole::class,
    ];
}
