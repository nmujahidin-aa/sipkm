<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Log;
use App\Enums\RoleEnum;
use App\Models\User;
use Error;

class LoginController extends Controller
{
    private $view;
    public function __construct()
    {
        $this->view = "pages.auth.";
    }
    public function index(){
        if(Auth::check()){
            return redirect()->route('dashboard.index');
        }
        return view($this->view."login");
    }

    public function post(LoginRequest $request)
    {
        try {

            $username = (empty($request->input("username"))) ? null : trim(htmlentities($request->input("username")));
            $password = (empty($request->input("password"))) ? null : trim(htmlentities($request->input("password")));

            // Deteksi tipe field berdasarkan pola masing-masing input
            if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
                $fieldType = 'email'; // Jika input adalah email
            } elseif (preg_match('/^\d{8,12}$/', $username)) {
                // Contoh pola untuk NIM atau NUPTK (8-10 digit)
                $fieldType = 'nim';
            } elseif (preg_match('/^\d{18}$/', $username)) {
                // Pola untuk NIDN (misalnya, 18 digit)
                $fieldType = 'nidn';
            } elseif (preg_match('/^\d{10}$/', $username)) {
                // Pola untuk NUPTK (misalnya, 10 digit)
                $fieldType = 'nuptk';
            } elseif (preg_match('/^\d{18}$/', $username)) {
                // Pola untuk NIP (misalnya, 18 digit)
                $fieldType = 'nip';
            } else {
                throw new \Exception("Nama pengguna tidak valid, gunakan NIM/NIDN/NUPK/NIP atau email @um.ac.id anda");
            }
            $rememberme = (empty($request->input('rememberme'))) ? false : true;

            $field = [
                $fieldType => $username,
                'password' => $password
            ];

            if (Auth::attempt($field, $rememberme)) {
                $user = Auth::user();

                // Cek apakah user memiliki salah satu role yang diizinkan
                if (!$user->hasRole([
                    RoleEnum::MAHASISWA,
                    RoleEnum::ADMINISTRATOR,
                    RoleEnum::DOSEN,
                    RoleEnum::PENALARAN,
                    RoleEnum::PKM_CENTER,
                ])) {
                    Auth::logout();
                    throw new Error("Anda tidak diperbolehkan mengakses menu ini");
                }

                // Tetapkan current_role_id berdasarkan prioritas role
                if($user->current_role_id == null){
                    if ($user->hasRole(RoleEnum::MAHASISWA)) {
                        $currentRole = $user->roles->where('name', RoleEnum::MAHASISWA)->first();
                    } elseif ($user->hasRole(RoleEnum::DOSEN)) {
                        $currentRole = $user->roles->where('name', RoleEnum::DOSEN)->first();
                    } else {
                        $currentRole = $user->roles->first(); // Default ke role pertama yang dimiliki
                    }
                }

                // Perbarui current_role_id
                if ($currentRole) {
                    $user->update(['current_role_id' => $currentRole->id]);
                }

                alert()->html('Berhasil', 'Login berhasil', 'success');
                return redirect()->intended(route('dashboard.index'));

            } else {
                throw new \Exception("Username atau password salah");
            }
        } catch (\Throwable $e) {
            Log::emergency($e->getMessage());

            alert()->html('Gagal',$e->getMessage(),'error');
            return redirect()->back()->withInput();
        }
    }

}
