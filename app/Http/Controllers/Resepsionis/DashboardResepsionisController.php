<?php

namespace App\Http\Controllers\Resepsionis;

use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\TemuDokter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardResepsionisController extends Controller
{
    public function index()
    {
        // Hitung jumlah data dari tiap tabel di menu
        $totalPet = Pet::count();
        $totalPemilik = Pemilik::count();
        $totalTemuDokter = TemuDokter::count();


        return view('resepsionis.dashboard-resepsionis', compact(
            'totalPet',
            'totalPemilik',
            'totalTemuDokter'
        ));
    }
}
