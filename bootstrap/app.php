<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // <-- BARIS INI WAJIB ADA
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    // ... sisa kodenya ...
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'api/terima-data-aws', // Kecualikan rute ini dari pemeriksaan CSRF
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
