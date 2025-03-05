<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\ChangePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    private $view;
    public function __construct()
    {
        $this->view = "pages.user.change-password.";
    }
    public function index()
    {
        return view($this->view.'index');
    }

    public function update(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        $validatedData = $request->validated();
        $user->update([
            'password' => Hash::make($validatedData['new_password'])
        ]);
        alert()->html('Berhasil', 'Password berhasil diperbarui', 'success');
        return redirect()->route('change-password.index');
    }
}
