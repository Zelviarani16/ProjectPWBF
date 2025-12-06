<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ProfilDokterController extends Controller
{
    /**
     * Tampilkan profil dokter
     */
    public function index()
    {
        $user = Auth::user();

        // Cek user adalah dokter
        $isDokter = DB::table('user as u')
            ->join('role_user as ru', 'u.iduser', '=', 'ru.iduser')
            ->join('role as r', 'ru.idrole', '=', 'r.idrole')
            ->where('u.iduser', $user->iduser)
            ->where('r.nama_role', 'dokter')
            ->exists();

        if (!$isDokter) {
            return redirect()->route('login')
                ->with('error', 'Anda tidak memiliki akses sebagai dokter.');
        }

        // Ambil data dokter, buat otomatis jika belum ada
        $dokter = Dokter::firstOrCreate(
            ['iduser' => $user->iduser],
            [
                'alamat'        => '',
                'no_hp'         => '',
                'bidang_dokter' => '',
                'jenis_kelamin' => '',
            ]
        );

        Log::info('Profil Dokter - Diakses/Auto Created', [
            'user_id' => $user->iduser,
            'dokter_id' => $dokter->id_dokter
        ]);

        return view('dokter.profil.index', compact('user', 'dokter'));
    }

    /**
     * Form edit profil dokter
     */
    public function edit()
    {
        $user = Auth::user();
        $dokter = Dokter::where('iduser', $user->iduser)->first();

        if (!$dokter) {
            return redirect()->route('dokter.profil.index')
                ->with('error', 'Data dokter tidak ditemukan.');
        }

        return view('dokter.profil.edit', compact('user', 'dokter'));
    }

    /**
     * Update profil dokter
     */
public function update(Request $request)
{
    $validated = $request->validate([
        'nama'           => 'required|string|max:255',
        'email'          => 'required|email|max:255',
        'alamat'         => 'required|string|max:255',
        'no_hp'          => 'required|string|max:15',
        'bidang_dokter'  => 'required|string|max:100',
        'jenis_kelamin'  => 'required|in:L,P',
    ]);

    /** @var \App\Models\User $user */

    $user = Auth::user();

    try {
        // Update user
        $user->update([
            'nama'  => $validated['nama'],
            'email' => $validated['email'],
        ]);

        // Ambil dokter
        $dokter = Dokter::where('iduser', $user->iduser)->first();

        if ($dokter) {
            // Update data dokter
            $dokter->update([
                'alamat'        => $validated['alamat'],
                'no_hp'         => $validated['no_hp'],
                'bidang_dokter' => $validated['bidang_dokter'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
            ]);
        } else {
            // Buat dokter baru jika belum ada
            $dokter = Dokter::create([
                'iduser'        => $user->iduser,
                'alamat'        => $validated['alamat'],
                'no_hp'         => $validated['no_hp'],
                'bidang_dokter' => $validated['bidang_dokter'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
            ]);
        }

        Log::info('Profil Dokter Updated', [
            'user_id'   => $user->iduser,
            'dokter_id' => $dokter->id_dokter,
        ]);

        return redirect()->route('dokter.profil.index')
            ->with('success', 'Profil dokter berhasil diperbarui.');

    } catch (\Exception $e) {
        Log::error('Update Profil Error', [
            'error' => $e->getMessage(),
        ]);

        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
}
