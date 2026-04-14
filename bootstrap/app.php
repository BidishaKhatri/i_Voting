<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'voter' => \App\Http\Middleware\CheckVoterSession::class,
            'biometric' => \App\Http\Middleware\CheckBiometric::class,
            'notvoted' => \App\Http\Middleware\CheckNotVoted::class,
            'results' => \App\Http\Middleware\CheckResultsAccess::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
