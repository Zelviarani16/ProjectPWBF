<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function index()
    {
        $pet = Pet::with(['pemilik.user', 'rasHewan'])->get();

        // ambil role user yang sedang login
        $role = Auth::user()->role;

        // arahkan view sesuai role
        if ($role === 'resepsionis') {
            return view('resepsionis.pet.index', compact('pet'));
        } elseif ($role === 'admin') {
            return view('admin.pet.index', compact('pet'));
        } elseif ($role === 'dokter') {
            return view('dokter.pet.index', compact('pet'));
        } elseif ($role === 'pemilik') {
            return view('pemilik.pet.index', compact('pet'));
        }

        // fallback jika role tidak dikenali
        abort(403, 'Akses tidak diizinkan');
    }
}
