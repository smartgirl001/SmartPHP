<?php

namespace App\Http;

use SmartPHP\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \SmartPHP\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \SmartPHP\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \SmartPHP\Session\Middleware\StartSession::class,
        \SmartPHP\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \SmartPHP\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

        'admin.auth' => \App\Http\Middleware\AdminAuth::class,
        'admin.power.check' => \App\Http\Middleware\PowerCheck::class,
    ];
}
