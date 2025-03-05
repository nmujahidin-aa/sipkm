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
use App\Helpers\ListBankHelper as Bank;
use App\Models\Faculty;

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
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $facultyId = $request->input('filter_faculty', 'all');
        $role = $request->input('filter_role', 'all');
        $angkatanId = $request->input('filter_angkatan', 'all');

        // Query dasar: Hanya mengambil users yang memiliki RoleEnum::MAHASISWA
        $query = User::whereHas('roles', function ($q) {
            $q->where('name', RoleEnum::MAHASISWA);
        })->with('faculty');

        // Jika ada filter role yang dipilih, tambahkan kondisi untuk role tersebut
        if ($role !== 'all') {
            $query->whereHas('roles', function ($q) use ($role) {
                $q->where('name', $role);
            });
        }

        // Filter berdasarkan pencarian
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                ->orWhere('nim', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Filter berdasarkan fakultas
        if ($facultyId !== 'all') {
            $query->where('faculty_id', $facultyId);
        }

        // Filter berdasarkan angkatan (2 digit pertama NIM)
        if ($angkatanId !== 'all') {
            $query->where('nim', 'like', $angkatanId . '%');
        }

        // Ambil data angkatan dari NIM
        $angkatan = User::whereNotNull('nim')
            ->where('nim', '!=', '')
            ->selectRaw('LEFT(nim, 2) as angkatan')
            ->distinct()
            ->orderBy('angkatan', 'desc')
            ->pluck('angkatan');

        // Paginate hasil query
        $students = $query->paginate(10);

        // Ambil semua fakultas
        $faculty = Faculty::all();

        $data = [
            'students' => $students,
            'search' => $search,
            'faculty' => $faculty,
            'angkatan' => $angkatan,
        ];

        if ($request->ajax()) {
            return view($this->view . "table", $data)->render();
        }
        return view($this->view . "index", $data);
    }

    public function edit(string $id = null){
        $students = null;
        $studyPrograms = StudyProgram::all();
        $banks = Bank::getListBank();
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
