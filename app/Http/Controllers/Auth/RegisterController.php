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
}
