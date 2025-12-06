<?php

namespace App\Http\Controllers\Perawat;

use App\Models\Pet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pet::with(['pemilik.user', 'ras.jenisHewan'])
            ->orderBy('idpet')
            ->get();

        return view('perawat.pasien.index', compact('pasien'));
    }
}
