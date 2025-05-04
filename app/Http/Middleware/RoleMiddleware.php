<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role, $roles)) {
            // Redirect ke halaman dashboard sesuai rolenya
            if ($user->role === 'buyer') {
                return redirect()->route('buyer.dashboard')->with('error', 'Kamu tidak punya akses ke halaman tersebut');
            } elseif ($user->role === 'seller') {
                return redirect()->route('seller.dashboard')->with('error', 'Kamu tidak punya akses ke halaman tersebut');
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('error', 'Kamu tidak punya akses ke halaman tersebut');
            }

            // Fallback kalau role tidak dikenali
            return redirect()->route('login')->with('error', 'Akses ditolak!');
        }

        return $next($request);
    }
}
