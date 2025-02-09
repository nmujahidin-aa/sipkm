<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SwitchRoleController extends Controller
{
    public function __invoke(Role $role)
    {
        abort_unless(Auth::user()->hasRole($role), 404);
        Auth::user()->update(['current_role_id' => $role->id]);
        return to_route('dashboard.index'); // Replace this with your own home route
    }
}
