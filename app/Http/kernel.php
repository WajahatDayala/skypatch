<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class kernel extends HttpKernel
{
    protected $middleware = [
        // Global middleware
    ];

    protected $middlewareGroups = [
        'web' => [
            // Middleware for web routes
        ],

        'api' => [
            // Middleware for API routes
        ],
    ];

    protected $routeMiddleware = [
        'role' => \App\Http\Middleware\RoleMiddleware::class, // Custom role middleware
        'admin.auth' => \App\Http\Middleware\AdminAuthMiddleware::class,
        // Other middleware
    ];
}
