<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;
use App\Models\KodeTindakanTerapi;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    /**
     * List semua rekam medis
     */
    public function index()
    {
        $rekam = RekamMedis::with([
            'reservasi.pet.pemilik.user',
            'roleUserDokter.user.roles'
        ])->orderBy('idrekam_medis', 'DESC')->get();

        return view('dokter.rekam-medis.index', compact('rekam'));
    }

    /**
     * Lihat detail rekam medis beserta detail tindakan
     */
    public function showDetail($id)
    {
        $rekam = RekamMedis::with([
            'detail.kodeTindakanTerapi',
            'reservasi.pet.pemilik.user',
            'reservasi.pet.ras.jenisHewan',
            'roleUserDokter.user.roles'
        ])->findOrFail($id);

        return view('dokter.rekam-medis.detail', compact('rekam'));
    }

    // ==============================
    // CRUD DETAIL REKAM MEDIS
    // ==============================

    /**
     * Form create detail rekam medis
     */
    public function createDetail($idRekam)
    {
        $rekam = RekamMedis::findOrFail($idRekam);
        $tindakan = KodeTindakanTerapi::all();

        return view('dokter.rekam-medis.detail-create', compact('rekam', 'tindakan'));
    }

    /**
     * Store detail rekam medis
     */
    public function storeDetail(Request $request, $idRekam)
    {
        $validated = $request->validate([
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail'                  => 'required|string|max:1000',
        ], [
            'idkode_tindakan_terapi.required' => 'Tindakan wajib dipilih',
            'idkode_tindakan_terapi.exists'   => 'Tindakan tidak valid',
            'detail.required'                 => 'Detail wajib diisi',
            'detail.max'                      => 'Detail maksimal 1000 karakter',
        ]);

        $validated['idrekam_medis'] = $idRekam;

        DetailRekamMedis::create($validated);

        return redirect()->route('dokter.rekam-medis.showDetail', $idRekam)
            ->with('success', 'Detail rekam medis berhasil ditambahkan');
    }

    /**
     * Form edit detail rekam medis
     */
    public function editDetail($id)
    {
        $detail = DetailRekamMedis::with('rekam', 'kodeTindakanTerapi')->findOrFail($id);
        $tindakan = KodeTindakanTerapi::all();

        return view('dokter.rekam-medis.detail-edit', compact('detail', 'tindakan'));
    }

    /**
     * Update detail rekam medis
     */
    public function updateDetail(Request $request, $id)
    {
        $detail = DetailRekamMedis::findOrFail($id);

        $validated = $request->validate([
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail'                  => 'required|string|max:1000',
        ]);

        $detail->update($validated);

        return redirect()->route('dokter.rekam-medis.showDetail', $detail->idrekam_medis)
            ->with('success', 'Detail rekam medis berhasil diperbarui');
    }

    /**
     * Hapus detail rekam medis
     */
    public function destroyDetail($id)
    {
        $detail = DetailRekamMedis::findOrFail($id);
        $idRekam = $detail->idrekam_medis;
        $detail->delete();

        return redirect()->route('dokter.rekam-medis.showDetail', $idRekam)
            ->with('success', 'Detail rekam medis berhasil dihapus');
    }
}
