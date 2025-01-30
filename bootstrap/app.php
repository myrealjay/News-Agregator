<?php

use App\Exceptions\InvalidSourceException;
use App\Traits\HasResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $responder = new class{
            use HasResponse;
        };

        $exceptions->render(function (AuthenticationException $e, Request $request) use($responder) {
            return $responder->sendResponse(false, $e->getMessage(), [], 401);
        });

        $exceptions->render(function (InvalidSourceException $e, Request $request) use($responder) {
            return $responder->sendResponse(false, $e->getMessage(), [], 401);
        });

        $exceptions->render(function (HttpException $e, $request) use($responder) {
            return $responder->sendResponse(false, $e->getMessage(), [], $e->getStatusCode());
        });
    })->create();
