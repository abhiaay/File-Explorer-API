<?php

use App\Traits\Http\ResponseTrait;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $responseTrait = new class() {
            use ResponseTrait;
        };
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            return true;
        });
        $exceptions->render(function(ValidationException $e, Request $request)use($responseTrait) {
            return $responseTrait->validationErrorResponse($e->errors());
        });
        $exceptions->render(function(NotFoundHttpException $e)use($responseTrait) {
            return $responseTrait->errorResponse('Data Not Found', Response::HTTP_NOT_FOUND);
        });
    })->create();
