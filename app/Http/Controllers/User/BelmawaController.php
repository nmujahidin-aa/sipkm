<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Belmawa;
use Illuminate\Support\Facades\Auth;

class BelmawaController extends Controller
{
    private $view;
    private $belmawa;
    public function __construct()
    {
        $this->view = "pages.user.belmawa.";
        $this->belmawa = new Belmawa();
    }
    public function index()
    {
        $belmawa = $this->belmawa::where('user_id', Auth::user()->id)->get();
        return view($this->view.'index',[
            'belmawa' => $belmawa,
        ]);
    }
}
