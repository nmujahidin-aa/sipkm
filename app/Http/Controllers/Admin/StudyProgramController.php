<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudyProgram;
use App\Models\Faculty;
use App\Http\Requests\Admin\StudyProgramRequest;


class StudyProgramController extends Controller
{
    private $view;
    private $studyPrograms;
    private $route;
    public function __construct(){
        $this->view = "pages.admin.study-program.";
        $this->studyPrograms = new StudyProgram();
        $this->route = "admin.study-program.";
    }

    public function index(){
        $studyPrograms = $this->studyPrograms::all();
        return view($this->view."index", ['studyPrograms' => $studyPrograms]);
    }

    public function edit(string $id = null){

        $studyPrograms = null;
        $faculties = Faculty::all();

        if ($id) {
            $studyPrograms = $this->studyPrograms::findOrFail($id);
        }
        return view($this->view.'edit', [
            'studyPrograms' => $studyPrograms,
            'faculties' => $faculties,
        ]);
    }

    public function store(StudyProgramRequest $request){
        if ($request->has('id')) {
            $studyProgram = $this->studyPrograms::findOrFail($request->id);
            $studyProgram->update($request->validated());
            alert()->html('Berhasil', 'Data berhasil diperbarui', 'success');
            return redirect()->route($this->route . 'index');
        } else {
            $studyProgram = $this->studyPrograms::create($request->validated());
            alert()->html('Berhasil', 'Data berhasil ditambahkan', 'success');
            return redirect()->route($this->route . 'index');
        }
    }

    public function single_destroy(string $id){
        $studyProgram = $this->studyPrograms::findOrFail($id);
        $studyProgram->delete();
        alert()->html('Berhasil', 'Data berhasil dihapus', 'success');
        return redirect()->route($this->route . 'index');
    }
}
