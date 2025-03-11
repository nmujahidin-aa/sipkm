<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SwitchRoleController;
use App\Helpers\RouteHelper;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ProposalController;
use App\Http\Controllers\Lecturer\ProposalController as LecturerProposalController;
use App\Http\Controllers\User\BelmawaController;
use App\Http\Controllers\User\ChangePasswordController as ChangePassword;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\AgendaController;

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

Route::group(['namespace'=>'App\Http\Controllers', 'middleware' => ['auth']], function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::group(["middleware"=>"profile"], function(){
        Route::get('/change-password', [ChangePassword::class, 'index'])->name('change-password.index');
        Route::post('/change-password', [ChangePassword::class, 'update'])->name('change-password.update');

        Route::get("/", "DashboardController@index")->name('dashboard.index');
        Route::get('/switch-role/{role}', SwitchRoleController::class)->name('switch-role');

        RouteHelper::make('proposal', 'proposal', ProposalController::class);
        Route::post('proposal/{proposal_id}/review', [ProposalController::class, 'storeReview'])->name('proposal.storeReview');
        Route::get('proposal/{proposal_id}/review/{id?}', [ProposalController::class, 'review'])->name('proposal.review');

        Route::get('/belmawa', [BelmawaController::class, 'index'])->name('belmawa.index');
        Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
    });

    // Route untuk dosen
    Route::group(["prefix"=>"dosen", "as"=>"dosen.", "middleware"=>"lecturer"], function(){
        RouteHelper::make('proposal', 'proposal', LecturerProposalController::class);
        Route::post('proposal/review/upload', [LecturerProposalController::class, 'upload'])->name('proposal.reviewUpload');
        Route::post('proposal/{proposal_id}/review', [LecturerProposalController::class, 'storeReview'])->name('proposal.storeReview');
        Route::get('proposal/{proposal_id}/review/{id?}', [LecturerProposalController::class, 'review'])->name('proposal.review');

        Route::get('belmawa', [BelmawaController::class, 'index'])->name('belmawa.index');
    });
});
