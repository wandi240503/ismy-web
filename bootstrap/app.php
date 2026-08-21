<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e, Request $request) {
            if (config('app.debug') || $request->has('debug')) {
                return response(
                    "<html><body style='font-family:sans-serif;padding:30px;background:#fff;'><h2>⚠️ Diagnostic Error Trace</h2><p><b>" . get_class($e) . ":</b> " . htmlspecialchars($e->getMessage()) . "</p><p><b>File:</b> " . $e->getFile() . ":" . $e->getLine() . "</p><pre style='background:#f4f4f5;padding:15px;border-radius:8px;font-size:12px;overflow:auto;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre></body></html>",
                    500
                );
            }
        });
    })->create();
