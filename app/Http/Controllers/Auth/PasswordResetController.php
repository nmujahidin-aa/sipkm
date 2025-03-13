<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\PasswordReset;
use App\Mail\ResetPass;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    private $view;
    private $route;
    private $user;

    public function __construct(){
        $this->view = "pages.auth.";
        $this->route = "auth.";
        $this->user = new User();
    }

    public function index(){
        return view($this->view."reset-password");
    }

    public function sendValidation(Request $request){
        $request->validate([
            "email" => "required|email|exists:users,email"
        ], [
            'email.exists' => 'Email tidak terdaftar',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
        ]);

        $emailExists = PasswordReset::where('email', $request->email)->first();

        if ($emailExists) {
            $tokenCreatedAt = Carbon::parse($emailExists->created_at);
            $currentDateTime = Carbon::now();

            if ($tokenCreatedAt->diffInMinutes($currentDateTime) <= 5) {
                alert()->error('Permintaan reset password sudah dilakukan dalam 5 menit terakhir');
                return redirect()->route('auth.reset-password.index');
            }
            $emailExists->delete();

            $token = Str::random(64);
            PasswordReset::create([
                'email' => $request->email,
                'token' => $token,

            ]);

            $data = new ResetPass($token, $request->email);
            Mail::to($request->email)->send($data);

            alert()->success('Email reset kata sandi berhasil dikirim');
            return redirect()->route('auth.reset-password.index');
        } else {
            $token = Str::random(64);
            PasswordReset::create([
                'email' => $request->email,
                'token' => $token,

            ]);
            $data = new ResetPass($token, $request->email);
            Mail::to($request->email)->send($data);

            alert()->success('Email reset kata sandi berhasil dikirim');
            return redirect()->route('auth.reset-password.index');
        }
    }

    /**
     * Display the reset password page form.
     *
     * @param string $token The token for password reset.
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function resetPasswordPage($token)
    {
        $passwordReset = PasswordReset::where('token', $token)->first();

        if (!$passwordReset) {
            return abort(404);
        }

        $tokenCreatedAt = Carbon::parse($passwordReset->created_at);
        $currentDateTime = Carbon::now();

        if ($tokenCreatedAt->diffInMinutes($currentDateTime) > 5) {
            $passwordReset->delete();
            return redirect()->route('auth.reset-password.index')->with('error', 'Token sudah tidak berlaku');
        }

        return view($this->view.'create-password', compact('token'));
    }


    /**
     * Reset the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword(Request $request)
    {
        $token = $request->token;
        $passwordReset = PasswordReset::where('token', $token)->first();

        if (!$passwordReset) {
            alert()->error('Token tidak valid');
            return redirect()->route('auth.reset-password.index');
        }

        $tokenCreatedAt = Carbon::parse($passwordReset->created_at);
        $currentDateTime = Carbon::now();


        if ($tokenCreatedAt->diffInMinutes($currentDateTime) > 5) {
            $passwordReset->delete();
            alert()->error('Token sudah tidak berlaku');
            return redirect()->route('auth.reset-password.index');
        }


        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $passwordReset->email)->first();
        if (!$user) {
            alert()->error('Email tidak terdaftar');
            return redirect()->route('auth.reset-password.index');
        }
        $user->password = Hash::make($request->password);
        $user->save();


        $passwordReset->delete();
        alert()->success('Kata sandi berhasil diubah');
        return redirect()->route('auth.login.index');
    }
}
