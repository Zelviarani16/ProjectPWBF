<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;

class DashboardPemilikController extends Controller
{

    // Dashboard utama pemilik
    public function index()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        if (!$pemilik) {
            // Bisa redirect, atau buat pemilik otomatis
            return redirect()->route('landing')->with('error', 'Data pemilik belum ada.');
        }

        $hewanCount = $pemilik->pets()->count();
        $jadwalCount = TemuDokter::whereIn('idpet', $pemilik->pets->pluck('idpet'))->count();

        return view('pemilik.dashboard', compact('user', 'pemilik', 'hewanCount', 'jadwalCount'));
    }


    // Profil pemilik
    public function profil()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;
        return view('pemilik.profil', compact('user','pemilik'));
    }

    // Daftar hewan milik pemilik
    public function hewan()
    {
        $user = Auth::user();
        $hewan = $user->pemilik->pets()->with('ras')->get();
        return view('pemilik.hewan', compact('hewan'));
    }

    // Jadwal temu dokter milik hewan pemilik
    public function jadwalTemuDokter()
    {
        $user = Auth::user();
        $hewanIds = $user->pemilik->pets->pluck('idpet');
        $jadwal = TemuDokter::whereIn('idpet', $hewanIds)->with('pet')->get();
        return view('pemilik.jadwal-temu-dokter', compact('jadwal'));
    }

    // Rekam medis milik hewan pemilik
    public function rekamMedis()
    {
        $user = Auth::user();
        $hewanIds = $user->pemilik->pets->pluck('idpet');
        $reservasiIds = TemuDokter::whereIn('idpet', $hewanIds)->pluck('idreservasi_dokter');
        $rekamMedis = RekamMedis::whereIn('idreservasi_dokter', $reservasiIds)->with('detail')->get();
        return view('pemilik.rekam-medis', compact('rekamMedis'));
    }

    // Detail rekam medis
    public function detailRekamMedis($id)
    {
        $rekamMedis = RekamMedis::with('detail.kodeTindakanTerapi')->findOrFail($id);
        return view('pemilik.detail-rekam-medis', compact('rekamMedis'));
    }
}
