<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
// Tiap model yg dipanggil harus didefinisikan disini
use App\Models\Pet;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pet::with(['pemilik.user', 'ras.jenisHewan'])
            ->orderBy('idpet')
            ->get();

        return view('dokter.pasien.index', compact('pasien'));
    }
}
