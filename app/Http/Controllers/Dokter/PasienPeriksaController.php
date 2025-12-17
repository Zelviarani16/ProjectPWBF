<?php

namespace App\Http\Controllers\Dokter;

use App\Models\RekamMedis;
use App\Models\TemuDokter;
use Illuminate\Http\Request;
use App\Models\DetailRekamMedis;
use App\Models\KodeTindakanTerapi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PasienPeriksaController extends Controller
{
    // =====================
    // 1. Daftar Pasien Pending (Status A)
    // =====================
    public function indexPending()
    {
        $user = Auth::user();

        // ini yg benar: ambil idrole_user, bukan idrole
        $activeRoleUserId = $user->roleUser->idrole_user;

        $data = TemuDokter::with(['pet', 'pet.pemilik'])
            ->where('idrole_user', $activeRoleUserId)
            ->where('status', 'P')
            ->orderBy('no_urut')
            ->get();

        return view('dokter.pasien.pending', compact('data'));
    }


    // =====================
    // 2. Halaman Dokter Memulai Pemeriksaan
    // =====================
    // public function periksa($id)
    // {
    //     $temu = TemuDokter::with(['pet', 'pet.pemilik'])
    //         ->findOrFail($id);

    //     // buat rekam medis jika belum ada
    //     $rekam = RekamMedis::firstOrCreate(
    //         ['idreservasi_dokter' => $id],
    //         [
    //             'idpet' => $temu->idpet,
    //             'anamnesa' => null,
    //             'diagnosa' => null,
    //             'temuan_klinis' => null,
    //         ]
    //     );
public function periksa($id)
{
    $rekam = RekamMedis::with('reservasi.pet.pemilik')->where('idreservasi_dokter', $id)->firstOrFail();

    // Cegat jika sudah selesai
    if ($rekam->reservasi->status !== 'P') {
        abort(403, 'Pemeriksaan sudah selesai');
    }

    // Ambil list kode tindakan
    $kodeTindakan = KodeTindakanTerapi::orderBy('kode')->get();

    // Ambil detail tindakan yang sudah ada (jika ada)
    $detail = DetailRekamMedis::with('tindakan')->where('idrekam_medis', $rekam->idrekam_medis)->get();

    // Render halaman create
    return view('dokter.rekam-medis.detail-create', compact('rekam', 'kodeTindakan', 'detail'));
}

public function storeDetail(Request $request, $id)
{
    $request->validate([
        'temuan_klinis' => 'required|string',
        'diagnosa' => 'required|string',
        'idkode_tindakan_terapi' => 'required|array',
    ]);

    $rekam = RekamMedis::where('idrekam_medis', $id)->firstOrFail();

    // Simpan semua tindakan
    foreach ($request->idkode_tindakan_terapi as $kodeId) {
        DetailRekamMedis::create([
            'idrekam_medis' => $rekam->idrekam_medis,
            'idkode_tindakan_terapi' => $kodeId,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
        ]);
    }

    return redirect()->route('dokter.rekam-medis.detail.create', $rekam->idrekam_medis)
        ->with('success', 'Detail tindakan berhasil ditambahkan!');
}

public function selesaiPemeriksaan($idReservasi)
{
    // Ambil rekam medis sesuai reservasi
    $rekam = DB::table('rekam_medis')
        ->where('idreservasi_dokter', $idReservasi)
        ->first();

    if (!$rekam) {
        return redirect()->back()->with('error', 'Rekam medis tidak ditemukan.');
    }

    // Ambil data temu dokter untuk cek status
    $temu = DB::table('temu_dokter')
        ->where('idreservasi_dokter', $idReservasi)
        ->first();

    if (!$temu) {
        return redirect()->back()->with('error', 'Data temu dokter tidak ditemukan.');
    }

    // Optional: pastikan temuan klinis dan diagnosa sudah diisi sebelum finalize
    if (is_null($rekam->temuan_klinis) || is_null($rekam->diagnosa)) {
        return redirect()->back()->with('error', 'Lengkapi temuan klinis dan diagnosa sebelum menyelesaikan pemeriksaan.');
    }

    // Update status di tabel temu_dokter menjadi 'S' (Selesai)
    DB::table('temu_dokter')
        ->where('idreservasi_dokter', $idReservasi)
        ->update(['status' => 'S']);

    return redirect()->route('dokter.rekam-medis.index')
        ->with('success', 'Pemeriksaan berhasil diselesaikan!');
}



}