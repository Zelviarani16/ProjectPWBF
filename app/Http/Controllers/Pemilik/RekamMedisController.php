<?php

namespace App\Http\Controllers\Pemilik;

use App\Models\RekamMedis;
use App\Models\TemuDokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{

    public function rekamMedis()
{
    $user = Auth::user();

    $rekamMedis = DB::table('rekam_medis as r')
        ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
        ->join('pet as p', 't.idpet', '=', 'p.idpet')

        // PEMILIK (BENAR)
        ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
        ->join('user as pemilik', 'pm.iduser', '=', 'pemilik.iduser')

        // ✅ DOKTER (LANGSUNG KE USER)
        ->join('user as dokter', 'r.dokter_pemeriksa', '=', 'dokter.iduser')

        ->select(
            'r.idrekam_medis',
            'r.created_at',
            'r.anamnesa',
            'r.temuan_klinis',
            'r.diagnosa',
            't.status',
            'p.nama as nama_hewan',
            'dokter.nama as nama_dokter',
            'r.idreservasi_dokter'
        )
        ->where('pm.iduser', $user->iduser)
        ->orderByDesc('r.created_at')
        ->get();

    return view('pemilik.rekam-medis.index', compact('rekamMedis'));
}



    public function detailRekamMedis($id)
    {
        $rekamMedis = RekamMedis::with('detail.kodeTindakanTerapi')->findOrFail($id);
        return view('pemilik.rekam-medis.detail', compact('rekamMedis'));
    }
}
