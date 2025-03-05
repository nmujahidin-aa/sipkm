<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudyProgram;
use App\Models\User;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use App\Enums\RoleEnum;
use App\Models\Setting;
class RegisterController extends Controller
{
    private $view;
    private $route;
    private $studyPrograms;
    public function __construct(){
        $this->route = "auth.register.";
        $this->view = "pages.auth.";
        $this->studyPrograms = new StudyProgram();
    }

    public function index(){
        $studyPrograms = $this->studyPrograms::all();

        return view($this->view.'register', [
            'studyPrograms' => $studyPrograms,
        ]);
    }

    public function post(RegisterRequest $request)
    {
        $setting = Setting::first();

        if (!$setting || !$setting->is_registration_open) {
            alert()->html('Gagal', 'Proses pendaftaran telah ditutup. Silakan hubungi PKM Center.', 'error');
            return redirect()->back()->withInput();
        }

        $data = $request->validated();
        $user = User::create($data);
        $user->assignRole(RoleEnum::MAHASISWA);
        event(new Registered($user));

        alert()->html('Berhasil', 'Akun berhasil dibuat, silahkan login', 'success');
        return redirect()->route('auth.login.index');
    }
}
