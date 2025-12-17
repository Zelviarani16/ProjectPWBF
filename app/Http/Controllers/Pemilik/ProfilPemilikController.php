<?php

namespace App\Http\Controllers\Pemilik;

use App\Models\Pemilik;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ProfilPemilikController extends Controller
{
    /**
     * ============================
     *  TAMPILKAN PROFIL PEMILIK
     * ============================
     */
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // ✅ Verifikasi bahwa user ini benar-benar PEMILIK
        $isPemilik = DB::table('user as u')
            ->join('role_user as ru', 'u.iduser', '=', 'ru.iduser')
            ->join('role as r', 'ru.idrole', '=', 'r.idrole')
            ->where('u.iduser', $user->iduser)
            ->where('r.nama_role', 'pemilik')
            ->exists();

        if (!$isPemilik) {
            return redirect()->route('login')
                ->with('error', 'Anda tidak memiliki akses sebagai pemilik.');
        }

        // ✅ Ambil data pemilik
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();

        // ✅ Jika belum ada, buat otomatis
        if (!$pemilik) {
            $pemilik = Pemilik::create([
                'no_wa'  => '',
                'alamat' => '',
                'iduser' => $user->iduser,
            ]);

            Log::info('Profil Pemilik - Auto Created', [
                'user_id'    => $user->iduser,
                'pemilik_id'=> $pemilik->idpemilik,
            ]);
        }

        // ✅ PASTI mengembalikan view
        return view('pemilik.profil.index', compact('user', 'pemilik'));
    }

    /**
     * ============================
     *  FORM EDIT PROFIL
     * ============================
     */
    public function edit()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $pemilik = Pemilik::where('iduser', $user->iduser)->first();

        if (!$pemilik) {
            return redirect()->route('pemilik.profil.index')
                ->with('error', 'Data pemilik tidak ditemukan.');
        }

        return view('pemilik.profil.edit', compact('user', 'pemilik'));
    }

    /**
     * ============================
     *  PROSES UPDATE PROFIL
     * ============================
     */
    public function update(Request $request)
    {
        // ✅ VALIDASI BENAR
        $validated = $request->validate([
            'nama'   => 'required|string|max:255',
            'no_wa'  => 'required|string|max:45',
            'alamat' => 'required|string|max:100',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        try {
            $pemilik = Pemilik::where('iduser', $user->iduser)->first();

            if (!$pemilik) {
                // ✅ Jika belum ada, buat baru
                $pemilik = Pemilik::create([
                    'no_wa'  => $validated['no_wa'],
                    'alamat' => $validated['alamat'],
                    'iduser' => $user->iduser,
                ]);
            } else {
                // ✅ Jika sudah ada, update
                $pemilik->update([
                    'no_wa'  => $validated['no_wa'],
                    'alamat' => $validated['alamat'],
                ]);
            }

            // ✅ Update nama user
            $user->update([
                'nama' => $validated['nama'],
            ]);

            Log::info('Profil Pemilik Updated', [
                'user_id'    => $user->iduser,
                'pemilik_id'=> $pemilik->idpemilik,
            ]);

            return redirect()->route('pemilik.profil.index')
                ->with('success', 'Profil berhasil diperbarui!');

        } catch (\Exception $e) {
            Log::error('Update Profil Pemilik Error', [
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
