<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Controllers\AdminController;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
      
        // $middleware->redirectTo([
        //     'admin' => \App\Http\Middleware\AdminAuthenticate::class,

        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
