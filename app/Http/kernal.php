<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Global middleware...
    ];

    protected $middlewareGroups = [
        // Middleware groups like 'web' and 'api'...
    ];

    protected $routeMiddleware = [
        // Register your custom middleware here
        'admin' => \App\Http\Middleware\IsAdmin::class,
    ];
}
