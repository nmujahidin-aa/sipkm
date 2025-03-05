<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudyProgram;
use App\Helpers\ListBankHelper as Bank;
use App\Http\Requests\User\ProfileRequest;

class ProfileController extends Controller
{
    private $view;
    public function __construct(){
        $this->view = "pages.user.profile.";
    }

    public function index(){
        $user = Auth::user();
        $studyPrograms = StudyProgram::all();
        $banks = Bank::getListBank();

        return view($this->view.'index', [
            'user' => $user,
            'studyPrograms' => $studyPrograms,
            'banks' => $banks,
        ]);
    }

    public function update(ProfileRequest $request){
        $user = Auth::user();
        $validatedData = $request->validated();
        $facultyId = StudyProgram::findOrFail($validatedData['study_program_id'])->faculty_id;
        $validatedData['faculty_id'] = $facultyId;

        $user->update($validatedData);
        alert()->html('Berhasil', 'Data berhasil diperbarui', 'success');
        return redirect()->route('profile.index');
    }
}
