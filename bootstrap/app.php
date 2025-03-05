<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->namespace('App\\Http\\Controllers\\Auth')
                ->prefix('auth')
                ->as('auth.')
                ->group(base_path('routes/auth.php'));

            Route::middleware(['web', 'auth', 'admin'])
                ->namespace('App\\Http\\Controllers\\Admin')
                ->prefix('admin')
                ->as('admin.')
                ->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function ($middleware) {
        $middleware->alias([
            'auth' => \App\Http\Middleware\AuthenticateMiddleware::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'profile' => \App\Http\Middleware\ProfileMiddleware::class,
            'lecturer' => \App\Http\Middleware\LecturerAccessMiddleware::class,
        ]);
        $middleware->web(append: [
            \Fahlisaputra\Minify\Middleware\MinifyHtml::class,
            \Fahlisaputra\Minify\Middleware\MinifyCss::class,
            \Fahlisaputra\Minify\Middleware\MinifyJavascript::class,
        ]);
    })
    ->withExceptions(function ($exceptions) {
        // Tambahkan exception handler di sini jika perlu
    })
    ->create();
