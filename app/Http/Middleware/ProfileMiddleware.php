<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if($user->name == null || $user->study_program_id == null){
            alert()->html('Gagal', 'Harap lengkapi profil anda terlebih dahulu', 'error');
            return redirect()->route('profile.index');
        }
        return $next($request);
    }
}
