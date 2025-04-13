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
        $middleware->alias([
            'LoginSession' => \App\Http\Middleware\LoginSession::class,
        ]);
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
                '/action_adduser',
                '/action_deleteuser',
                '/action_addmerek',
                '/action_deletemerek',
                '/action_addkategori',
                '/action_addasset',
                '/appr_peminjaman',
                '/action_pengembalian',
                '/action_addpengadaan',
                '/appr_pengadaan',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
