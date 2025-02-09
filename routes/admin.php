<?php

use Illuminate\Support\Facades\Route;
use App\Helpers\RouteHelper;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\LecturerController;
use App\Http\Controllers\Admin\StudyProgramController;
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

RouteHelper::make('student', 'student', StudentController::class);
RouteHelper::make('lecturer', 'lecturer', LecturerController::class);
RouteHelper::make('study-program', 'study-program', StudyProgramController::class);

