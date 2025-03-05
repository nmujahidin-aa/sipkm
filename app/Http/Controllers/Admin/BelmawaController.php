<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Belmawa;
use App\Http\Requests\Admin\BelmawaRequest;
use App\Models\User;

class BelmawaController extends Controller
{
    private $view;
    private $belmawa;
    private $route;
    private $user;
    public function __construct(){
        $this->view = "pages.admin.belmawa.";
        $this->belmawa = new Belmawa();
        $this->route = "admin.belmawa.";
        $this->user = new User();
    }

    public function index(){
        $belmawa = $this->belmawa::all();
        return view($this->view.'index',[
            'belmawa' => $belmawa,
        ]);
    }

    public function edit(string $id = null){
        $belmawa = null;
        $user = $this->user::all();
        $existingUserIds = Belmawa::pluck('user_id')->toArray();
        if($id){
            $belmawa = $this->belmawa::find($id);
        }

        return view($this->view.'edit',[
            'belmawa' => $belmawa,
            'user' => $user,
            'existingUserIds' => $existingUserIds
        ]);
    }

    public function store(BelmawaRequest $request){
        $validatedData = $request->validated();

        if ($request->has('id')) {
            $belmawa = $this->belmawa::findOrFail($request->id);
            $belmawa->update($validatedData);
            alert()->html('Berhasil', 'Data berhasil diperbarui', 'success');
            return redirect()->route($this->route . 'index');
        } else {
            $belmawa = $this->belmawa::create($validatedData);
            alert()->html('Berhasil', 'Data berhasil ditambahkan', 'success');
            return redirect()->route($this->route . 'index');
        }
    }

    public function single_destroy(string $id){
        $belmawa = $this->belmawa::findOrFail($id);
        $belmawa->delete();
        alert()->html('Berhasil', 'Data berhasil dihapus', 'success');
        return redirect()->route($this->route . 'index');
    }
}
