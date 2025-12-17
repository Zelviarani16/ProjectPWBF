<?php

namespace App\Http\Controllers\Perawat;

use App\Models\Pet;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardPerawatController extends Controller
{
    public function index()
    {
        // Hitung jumlah data dari tiap tabel di menu
        $totalPet = Pet::count();
        $totalRekamMedis = RekamMedis::count();

        return view('perawat.dashboard-perawat', compact(
            'totalPet',
            'totalRekamMedis'
        ));
    }
}
