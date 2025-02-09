<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class RouteHelper
{
    public static function make($prefix, $as, $controller) {
        Route::group(['prefix' => $prefix, 'as' => $as . '.', 'namespace' => $controller], function () use ($controller) {
            Route::get('/', [$controller, 'index'])->name('index');
            Route::get('/create', [$controller, 'create'])->name('create');
            Route::post('/', [$controller, 'store'])->name('store');
            Route::get('/edit/{id?}', [$controller, 'edit'])->name('edit');
            Route::post('/update/{id}', [$controller, 'update'])->name('update');
            Route::delete('/delete', [$controller, 'destroy'])->name('destroy');
            Route::delete('/delete/{id}', [$controller, 'single_destroy'])->name('single_destroy');
        });
    }
}
