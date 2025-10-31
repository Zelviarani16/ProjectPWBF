<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class isPemilik
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
     if (Auth::check() && Auth::user()->role->nama_role === 'pemilik') {
            return $next($request);
        }

        // Jika bukan pemilik, arahkan sesuai rolenya
        if (Auth::check()) {
            if (Auth::user()->role->nama_role === 'administrator') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role->nama_role === 'resepsionis') {
                return redirect()->route('resepsionis.dashboard');
            }
        }

        // Kalau belum login
        return redirect('/login');
    }
}