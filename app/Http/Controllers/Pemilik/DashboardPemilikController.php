<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;
use App\Models\RekamMedis;

class DashboardPemilikController extends Controller
{
    // Dashboard utama pemilik
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Ambil record pemilik terkait user ini (relasi di model User: pemilik)
        $pemilik = $user->pemilik;

        // Jika belum punya record pemilik, set semua statistik ke 0
        if (!$pemilik) {
            $totalPet = 0;
            $totalTemuDokter = 0;
            $totalRekamMedis = 0;

            return view('pemilik.dashboard-pemilik', compact(
                'totalPet',
                'totalTemuDokter',
                'totalRekamMedis'
            ));
        }

        // Hitung jumlah hewan milik pemilik ini
        // gunakan relasi agar konsisten dengan model (mis. $pemilik->pets())
        $totalPet = $pemilik->pets()->count();

        // Ambil id hewan milik pemilik ini (untuk query selanjutnya)
        $hewanIds = $pemilik->pets()->pluck('idpet'); // collection of idpet

        // Jika tidak ada hewan, set 0 untuk lainnya juga
        if ($hewanIds->isEmpty()) {
            $totalTemuDokter = 0;
            $totalRekamMedis = 0;
        } else {
            // Hitung total temu dokter untuk hewan-hewan milik pemilik ini
            $totalTemuDokter = TemuDokter::whereIn('idpet', $hewanIds)->count();

            // Ambil id reservasi yang terkait (dipakai oleh RekamMedis)
            $reservasiIds = TemuDokter::whereIn('idpet', $hewanIds)
                ->pluck('idreservasi_dokter');

            // Jika tidak ada reservasi -> 0, else hitung rekam medis yang memiliki idreservasi_dokter tersebut
            if ($reservasiIds->isEmpty()) {
                $totalRekamMedis = 0;
            } else {
                $totalRekamMedis = RekamMedis::whereIn('idreservasi_dokter', $reservasiIds)->count();
            }
        }

        return view('pemilik.dashboard-pemilik', compact(
            'totalPet',
            'totalTemuDokter',
            'totalRekamMedis'
        ));
    }
}
