<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isResepsionis
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user tidak terautentifikasi. redirect ke login
        if (!Auth::check()) {
            return redirect()->route('login');
        }


        // Ambil role dari session atau dari relasi user
        $userRole = (int) session('user_role');

        if ($userRole === 4) {
            return $next($request);

        } else {
            return abort('error', 'Akses ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
        }

    }
}