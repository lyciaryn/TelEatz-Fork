<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        //Cek jika user tidak login atau tidak memiliki role yang sesuai
        if (!$user || !in_array($user->role, $roles)) {
            return redirect()->route('login')->with('error', 'Akses ditolak! Kamoe gak punya izin untuk mengakses halaman');
        }

        return $next($request);
    }
}
