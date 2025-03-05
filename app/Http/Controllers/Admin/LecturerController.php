<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Enums\RoleEnum;
use App\Http\Requests\Admin\LecturerRequest;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\StudyProgram;
use App\Models\Faculty;


class LecturerController extends Controller
{
    private $view;
    private $lecturers;
    private $route;
    public function __construct(){
        $this->view = "pages.admin.lecturer.";
        $this->lecturers = new User();
        $this->route = "admin.lecturer.";
    }
    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $facultyId = $request->input('filter_faculty', 'all');
        $role = $request->input('filter_role', 'all');

        // Query dasar: Hanya mengambil users yang memiliki RoleEnum::DOSEN
        $query = User::whereHas('roles', function ($q) {
            $q->where('name', RoleEnum::DOSEN);
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
                ->orWhere('nip', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Filter berdasarkan fakultas
        if ($facultyId !== 'all') {
            $query->where('faculty_id', $facultyId);
        }

        // Paginate hasil query
        $lecturers = $query->paginate(10);

        // Ambil semua fakultas
        $faculty = Faculty::all();

        $data = [
            'lecturers' => $lecturers,
            'search' => $search,
            'faculty' => $faculty,
        ];

        if ($request->ajax()) {
            return view($this->view . "table", $data)->render();
        }
        return view($this->view . "index", $data);
    }

    public function edit(string $id = null){
        $lecturers = null;
        $studyPrograms = StudyProgram::all();
        $banks = ['BCA', 'BNI', 'BRI', 'Mandiri', 'BSI', 'BTN', 'CIMB Niaga', 'Danamon', 'Maybank', 'OCBC NISP', 'Panin', 'Permata', 'UOB', 'Citibank', 'HSBC', 'JTrust', 'Mega', 'Muamalat', 'Bukopin', 'BTPN', 'DBS', 'MNC', 'Sinarmas', 'Bank Jatim'];
        $roles = Role::all();

        if ($id) {
            $lecturers = $this->lecturers::findOrFail($id);
        }
        return view($this->view.'edit', [
            'lecturers' => $lecturers,
            'studyPrograms' => $studyPrograms,
            'roles' => $roles,
            'banks' => $banks,
        ]);
    }

    public function store(LecturerRequest $request){
        $validatedData = $request->validated();
        $facultyId = StudyProgram::findOrFail($validatedData['study_program_id'])->faculty_id;
        $validatedData['faculty_id'] = $facultyId;


        if ($request->has('id')) {
            $lecturer = $this->lecturers::findOrFail($request->id);
            $lecturer->update($validatedData);
            if ($request->has('roles')) {
                $lecturer->syncRoles($request->roles);
            }
            alert()->html('Berhasil', 'Data berhasil diperbarui', 'success');
            return redirect()->route($this->route . 'index');
        } else {
            $lecturer = $this->lecturers::create($validatedData);

            if ($request->has('roles')) {
                $lecturer->assignRole($request->roles);
            } else {
                $lecturer->assignRole(RoleEnum::DOSEN);
            }

            alert()->html('Berhasil', 'Data berhasil ditambahkan', 'success');
            return redirect()->route($this->route . 'index');
        }
    }

    public function single_destroy(string $id){
        $lecturer = $this->lecturers::findOrFail($id);
        $lecturer->delete();
        alert()->html('Berhasil', 'Data berhasil dihapus', 'success');
        return redirect()->route($this->route . 'index');
    }
}
