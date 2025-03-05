<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LecturerAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (empty($user) || $user->current_role_id != 3) {
            alert()->html('Gagal', 'Anda tidak diperbolehkan mengakses halaman ini', 'error');

            return redirect()->back();
        }

        return $next($request);
    }
}
