<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            // Route::namespace('vue')->prefix('vue')->name('vue.')->group(base_path('routes/vue.php'));
            Route::prefix('vue')->name('vue.')->group(base_path('routes/vue.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            //  'admin'=> AdminMiddlewre::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e) {
            if ( $e instanceof AccessDeniedHttpException ) {
                /* This may be overly specific, but I want to handle other
                   potential AccessDeniedHttpExceptions when I come
                   across them */
                   return response()->json(['error' => 'Unauthorized'], 401);

                if ( $e->getPrevious() instanceof AuthorizationException ) {
                    return redirect()
                        ->route('dashboard')
                        ->withErrors($e->getMessage());
                }
            }
            if ($e instanceof AuthenticationException){
                return response()->json(['error' => 'Unauthorized - Token not provided or invalid'], 401);
            }

            if ($e instanceof NotFoundHttpException) {
                return response()->json([
                    'error' => 'Route not found.'
                ], 404);
            }
        
            if ($e instanceof ModelNotFoundException) {
                return response()->json([
                    'error' => 'Resource not found.'
                ], 404);
            }
        });
    })->create();


 
    // https://medium.com/@tutsmake.com/laravel-11-create-custom-route-file-tutorial-bcfb3abf0841
  
