<?php
use Illuminate\Foundation\Application;
use App\Http\Middleware\CheckUserActive;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([
            'active' => CheckUserActive::class,
        ]);

        // si quieres mantener otros:
        // $middleware->alias('ValidateLinkPassword', \App\Http\Middleware\ValidateLinkPassword::class);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (HttpException $e, Request $request) {
            if ($e->getStatusCode() === 419) {
                return redirect()->route('login')
                    ->with('message', 'Tu sesión expiró por inactividad. Por favor, inicia sesión de nuevo.');
            }
        });
    })->create();
