<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pet;
use App\Models\Role;
use App\Models\User;
use App\Models\Pemilik;
use App\Models\Kategori;
use App\Models\RasHewan;
use App\Models\JenisHewan;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use App\Http\Controllers\Controller;

class DashboardAdminController extends Controller
{
    public function index()
    {
        // Hitung jumlah data dari setiap tabel
        $totalJenisHewan = JenisHewan::count();
        $totalRasHewan = RasHewan::count();
        $totalKategori = Kategori::count();
        $totalKategoriKlinis = KategoriKlinis::count();
        $totalKodeTindakan = KodeTindakanTerapi::count();
        $totalPet = Pet::count();
        $totalUsers = User::count();
        $totalRoles = Role::count();
        $totalPemilik = Pemilik::count();

        // Total semua data master (opsional)
        $totalAllData = $totalJenisHewan + $totalRasHewan + $totalKategori + $totalKategoriKlinis + $totalKodeTindakan + $totalPet + $totalUsers + $totalRoles + $totalPemilik;

        return view('admin.dashboard-admin', compact(
            'totalJenisHewan',
            'totalRasHewan',
            'totalKategori',
            'totalKategoriKlinis',
            'totalKodeTindakan',
            'totalPet',
            'totalUsers',
            'totalRoles',
            'totalPemilik',
            'totalAllData'
        ));
    }
}



// BENERAN DASHBOARD ADMIN