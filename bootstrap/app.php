<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
         $exceptions->render(function (Illuminate\Auth\AuthenticationException $e, Illuminate\Http\Request $request) {
            // Determine which guard caused the exception
            $guard = $e->guards()[0] ?? null;

            if ($request->expectsJson()) {
                return response()->json(['message' => $e->getMessage()], 401);
            }

            // Redirect based on guard
            if ($guard === 'admin') {
                return redirect()->guest(route('admin.login'));
            }

            return redirect()->guest(route('login'));
        });
    })->create();
