<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\Admin\SettingRequest;

class SettingController extends Controller
{
    private $view;
    private $setting;
    private $route;
    public function __construct(){
        $this->view = "pages.admin.setting.";
        $this->setting = new Setting();
        $this->route = "admin.setting.";
    }
    public function index(){
        $setting = $this->setting::first();

        return view($this->view . "index",[
            'setting' => $setting
        ]);
    }

    public function store(SettingRequest $request){
        $validatedData = $request->validated();

        if ($request->has('id')) {
            $setting = $this->setting::findOrFail($request->id);
            $setting->update($validatedData);
            alert()->html('Berhasil', 'Data berhasil diperbarui', 'success');
            return redirect()->route($this->route . 'index');
        } else {
            $setting = $this->setting::create($validatedData);
            alert()->html('Berhasil', 'Data berhasil ditambahkan', 'success');
            return redirect()->route($this->route . 'index');
        }
    }
}
