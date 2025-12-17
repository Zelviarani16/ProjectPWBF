<?php

namespace App\Http\Controllers\Pemilik;

use App\Models\TemuDokter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TemuDokterController extends Controller
{
    public function TemuDokter()
    {
        $user = Auth::user();
        $hewanIds = $user->pemilik->pets->pluck('idpet');
        $jadwal = TemuDokter::whereIn('idpet', $hewanIds)->with('pet')->get();
        return view('pemilik.temu-dokter.index', compact('jadwal'));
    }
}
