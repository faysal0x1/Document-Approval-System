<?php

use App\Console\Commands\MakeResourceFromModel;
use App\Http\Middleware\DashboardRedirect;
use App\Http\Middleware\Handle403Redirect;
use App\Http\Middleware\JwtPermissionMiddleware;
use App\Http\Middleware\JwtRoleMiddleware;
use App\Http\Middleware\PermissionMiddleware;
use App\Http\Middleware\SetUserRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Middleware\SubstituteBindings;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\Authenticate;
use PHPOpenSourceSaver\JWTAuth\Http\Middleware\RefreshToken;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => DashboardRedirect::class,
            'roleName' => SetUserRole::class,
            'permission' => PermissionMiddleware::class,
            'jwt.auth' => Authenticate::class,
            'jwt.refresh' => RefreshToken::class,
            'roles' => JwtRoleMiddleware::class,
            'permissions' => JwtPermissionMiddleware::class,
        ]);
        $middleware->web(append: [
            Handle403Redirect::class,
        ]);
        $middleware->group('api', [
            //            ThrottleRequests::class.':api',
            SubstituteBindings::class,
        ]);
    })
    ->withCommands([
        MakeResourceFromModel::class,
    ])
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
