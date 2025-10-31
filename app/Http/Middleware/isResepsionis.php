<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isResepsionis
{
    /**
     * Handle an incoming request.
     * Bisa menerima parameter role, misalnya: checkRole:1,4
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // ambil role user dari relasi user atau session
        $userRole = session('user_role') ?? Auth::user()->role ?? null;

        // kalau route tidak memerlukan role spesifik, cukup pastikan user login
        if (empty($roles)) {
            return $next($request);
        }

        // kalau userRole-nya ada dalam daftar role yang diizinkan
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        abort(403, 'Akses tidak diizinkan.');
    }
}
