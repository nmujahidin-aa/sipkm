<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudyProgram;
use App\Enums\RoleEnum;
use App\Http\Requests\Admin\StudentRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    private $view;
    private $students;
    private $route;
    public function __construct(){
        $this->view = "pages.admin.student.";
        $this->students = new User();
        $this->route = "admin.student.";
    }
    public function index(){
        // ambil semua user yang mempunyai RoleEnum::STUDENT
        $students = $this->students::role(RoleEnum::MAHASISWA)->get();
        return view($this->view."index", ['students' => $students]);
    }

    public function edit(string $id = null){
        $students = null;
        $studyPrograms = StudyProgram::all();
        $banks = ['BCA', 'BNI', 'BRI', 'Mandiri', 'BSI', 'BTN', 'CIMB Niaga', 'Danamon', 'Maybank', 'OCBC NISP', 'Panin', 'Permata', 'UOB', 'Citibank', 'HSBC', 'JTrust', 'Mega', 'Muamalat', 'Bukopin', 'BTPN', 'DBS', 'MNC', 'Sinarmas', 'Bank Jatim'];
        $roles = Role::all();

        if ($id) {
            $students = $this->students::findOrFail($id);
        }
        return view($this->view.'edit', [
            'students' => $students,
            'studyPrograms' => $studyPrograms,
            'roles' => $roles,
            'banks' => $banks,
        ]);
    }

    public function store(StudentRequest $request){
        $validatedData = $request->validated();
        $facultyId = StudyProgram::findOrFail($validatedData['study_program_id'])->faculty_id;
        $validatedData['faculty_id'] = $facultyId;


        if ($request->has('id')) {
            $student = $this->students::findOrFail($request->id);
            $student->update($validatedData);
            if ($request->has('roles')) {
                $student->syncRoles($request->roles);
            }
            alert()->html('Berhasil', 'Data berhasil diperbarui', 'success');
            return redirect()->route($this->route . 'index');
        } else {
            $student = $this->students::create($validatedData);

            if ($request->has('roles')) {
                $student->assignRole($request->roles);
            } else {
                $student->assignRole(RoleEnum::MAHASISWA);
            }

            alert()->html('Berhasil', 'Data berhasil ditambahkan', 'success');
            return redirect()->route($this->route . 'index');
        }
    }

    public function single_destroy(string $id){
        $student = $this->students::findOrFail($id);
        $student->delete();
        alert()->html('Berhasil', 'Data berhasil dihapus', 'success');
        return redirect()->route($this->route . 'index');
    }
}
