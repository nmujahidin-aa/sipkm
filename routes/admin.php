<?php

use Illuminate\Support\Facades\Route;
use App\Helpers\RouteHelper;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\Admin\StudyProgramController;
use App\Http\Controllers\Admin\ProposalController;
use App\Http\Controllers\Admin\BelmawaController;
use App\Http\Controllers\Admin\SettingController;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Route ini telah didaftarkan dalam **RouteServiceProvider** dengan konfigurasi khusus sebagai berikut:
| - **Prefix**: `admin`
| - **As**: `admin.`
| - **Namespace**: `Admin`
|
| Route ini mengarahkan langsung ke Controller yang berada di dalam folder **Admin**.
| Dengan menggunakan pengaturan ini, semua route yang didefinisikan akan otomatis memiliki prefix `admin` dan dapat diakses dengan nama alias yang dimulai dengan `admin.`
| Contohnya, `admin.index` akan merujuk pada method `index` dalam Controller yang sesuai di namespace **Admin**.
| Pengaturan ini memudahkan pengelolaan dan akses route secara terstruktur dalam aplikasi Anda.
|
*/


Route::group(["middleware"=>"auth"], function(){
    RouteHelper::make('student', 'student', StudentController::class);
    RouteHelper::make('lecturer', 'lecturer', LecturerController::class);
    RouteHelper::make('study-program', 'study-program', StudyProgramController::class);

    RouteHelper::make('proposal', 'proposal', ProposalController::class);
    Route::post('proposal/review/upload', [ProposalController::class, 'upload'])->name('proposal.reviewUpload');
    Route::post('proposal/{proposal_id}/review', [ProposalController::class, 'storeReview'])->name('proposal.storeReview');
    Route::get('proposal/{proposal_id}/review/{id?}', [ProposalController::class, 'review'])->name('proposal.review');

    RouteHelper::make('belmawa', 'belmawa', BelmawaController::class);
    RouteHelper::make('setting', 'setting', SettingController::class);
});
