<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SwitchRoleController;
use App\Helpers\RouteHelper;
use App\Http\Controllers\User\ProposalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace'=>'App\Http\Controllers', 'middleware' => ['App\Http\Middleware\AuthenticateMiddleware']], function () {
    Route::get("/", "DashboardController@index")->name('dashboard.index');
    Route::get('/switch-role/{role}', SwitchRoleController::class)->name('switch-role');

    RouteHelper::make('proposal', 'proposal', ProposalController::class);
});
