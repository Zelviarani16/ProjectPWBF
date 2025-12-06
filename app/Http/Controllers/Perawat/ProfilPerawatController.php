<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\Perawat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProfilPerawatController extends Controller
{
    // Halaman view profil (read-only)
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Verifikasi user adalah perawat
        $isPerawat = DB::table('user as u')
            ->join('role_user as ru', 'u.iduser', '=', 'ru.iduser')
            ->join('role as r', 'ru.idrole', '=', 'r.idrole')
            ->where('u.iduser', $user->iduser)
            ->where('r.nama_role', 'perawat')
            ->exists();

        if (!$isPerawat) {
            return redirect()->route('login')
                ->with('error', 'Anda tidak memiliki akses sebagai perawat.');
        }

        // Cek apakah data perawat ada
        $perawat = Perawat::where('iduser', $user->iduser)->first();
        
        // Jika tidak ada, buat otomatis
        if (!$perawat) {
            $perawat = Perawat::create([
                'alamat'        => '',
                'no_hp'         => '',
                'jenis_kelamin' => 'P',
                'pendidikan'    => '',
                'iduser'        => $user->iduser,
            ]);
            
            Log::info('Profil Perawat - Auto Created', [
                'user_id' => $user->iduser,
                'perawat_id' => $perawat->id_perawat
            ]);
        }

        return view('perawat.profil.index', compact('user', 'perawat'));
    }

    // Halaman form edit profil
    public function edit()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $perawat = Perawat::where('iduser', $user->iduser)->first();
        
        if (!$perawat) {
            return redirect()->route('perawat.profil.index')
                ->with('error', 'Data perawat tidak ditemukan.');
        }

        return view('perawat.profil.edit', compact('user', 'perawat'));
    }

    // Proses update profil
    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:255',
            'email'         => 'required|email|max:255',
            'alamat'        => 'required|string|max:100',
            'no_hp'         => 'required|string|max:45',
            'pendidikan'    => 'required|string|max:100',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        try {
            $perawat = Perawat::where('iduser', $user->iduser)->first();
            
            if (!$perawat) {
                $perawat = Perawat::create([
                    'alamat'        => $validated['alamat'],
                    'no_hp'         => $validated['no_hp'],
                    'jenis_kelamin' => 'P',
                    'pendidikan'    => $validated['pendidikan'],
                    'iduser'        => $user->iduser,
                ]);
            } else {
                $perawat->update([
                    'alamat'     => $validated['alamat'],
                    'no_hp'      => $validated['no_hp'],
                    'pendidikan' => $validated['pendidikan'],
                ]);
            }

            $user->update([
                'nama'  => $validated['nama'],
                'email' => $validated['email'],
            ]);

            Log::info('Profil Updated', [
                'user_id' => $user->iduser,
                'perawat_id' => $perawat->id_perawat
            ]);

            return redirect()->route('perawat.profil.index')
                ->with('success', 'Profil berhasil diperbarui!');
            
        } catch (\Exception $e) {
            Log::error('Update Profil Error', [
                'error' => $e->getMessage(),
            ]);
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}