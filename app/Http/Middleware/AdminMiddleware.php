<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        $admin_role_id = [ 1, 4, 5];
        if (empty($user) || !in_array($user->current_role_id, $admin_role_id)) {
            alert()->html('Gagal', 'Anda tidak diperbolehkan mengakses halaman ini', 'error');
            return redirect()->back();
        }

        return $next($request);
    }
}
