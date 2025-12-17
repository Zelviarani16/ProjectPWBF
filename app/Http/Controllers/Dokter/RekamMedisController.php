<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    // Index semua rekam medis pasien
    public function index()
    {
        $rekam = DB::table('rekam_medis as r')
            ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')
            ->join('user as pemilik', 'p.idpemilik', '=', 'pemilik.iduser')
            ->join('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->join('user as dokter', 'ru.iduser', '=', 'dokter.iduser')
            ->select(
                'r.idrekam_medis',
                'r.created_at',
                'r.idreservasi_dokter',
                'p.nama as nama_pet',
                'r.anamnesa',
                'r.temuan_klinis',
                'r.diagnosa',
                'dokter.nama as nama_dokter'
            )
            ->orderByDesc('r.idrekam_medis')
            ->get();

        return view('dokter.rekam-medis.index', compact('rekam'));
    }


    // Tampilkan form detail rekam medis (dokter mengisi)
public function createDetail($id)
{
    $rekam = DB::table('rekam_medis as r')
        ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
        ->join('pet as p', 't.idpet', '=', 'p.idpet')
        ->join('user as pemilik', 'p.idpemilik', '=', 'pemilik.iduser') // ✅ fix iduser
        ->select(
            'r.idrekam_medis',
            'r.anamnesa',
            'p.nama as nama_pet',
            'pemilik.nama as nama_pemilik'
        )
        ->where('r.idrekam_medis', $id)
        ->first();

    $kodeTindakan = DB::table('kode_tindakan_terapi')->orderBy('kode')->get();

    return view('dokter.rekam-medis.detail-create', compact('rekam', 'kodeTindakan'));
}


    // Simpan detail rekam medis yang diisi dokter
// Simpan detail rekam medis yang diisi dokter
public function storeDetail(Request $request, $id)
{
    $request->validate([
        'temuan_klinis' => 'required|string',
        'diagnosa' => 'required|string',
        'idkode_tindakan_terapi' => 'required', // single value
    ]);

    // Update temuan klinis & diagnosa di rekam_medis (tanpa updated_at)
    DB::table('rekam_medis')->where('idrekam_medis', $id)->update([
        'temuan_klinis' => $request->temuan_klinis,
        'diagnosa' => $request->diagnosa,
    ]);

    // Simpan kode tindakan baru ke detail_rekam_medis
    if($request->idkode_tindakan_terapi){
        DB::table('detail_rekam_medis')->insert([
            'idrekam_medis' => $id,
            'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
            'detail' => $request->detail,
        ]);
    }

    return redirect()->back()->with('success', 'Detail tindakan berhasil ditambahkan!');
}



    // Tampilkan detail rekam medis (readonly)
    public function showDetail($id)
    {
        $rekam = DB::table('rekam_medis as r')
            ->join('temu_dokter as t', 'r.idreservasi_dokter', '=', 't.idreservasi_dokter')
            ->join('pet as p', 't.idpet', '=', 'p.idpet')

            // 🔽 JOIN RAS & JENIS (INI YANG BENAR)
            ->leftJoin('ras_hewan as rh', 'p.idras_hewan', '=', 'rh.idras_hewan')
            ->leftJoin('jenis_hewan as jh', 'rh.idjenis_hewan', '=', 'jh.idjenis_hewan')

            ->join('user as pemilik', 'p.idpemilik', '=', 'pemilik.iduser')

            // dokter lewat role_user
            ->join('role_user as ru', 't.idrole_user', '=', 'ru.idrole_user')
            ->join('user as dokter', 'ru.iduser', '=', 'dokter.iduser')

            ->select(
                'r.idrekam_medis',
                'r.anamnesa',
                'r.temuan_klinis',
                'r.diagnosa',
                'r.created_at',

                'p.nama as nama_pet',
                'pemilik.nama as nama_pemilik',

                // 🔽 INI YANG DIPAKAI DI BLADE
                'rh.nama_ras',
                'jh.nama_jenis_hewan',

                'dokter.nama as nama_dokter',
                't.status as status_reservasi',
                'r.idreservasi_dokter'
            )
            ->where('r.idrekam_medis', $id)
            ->first();

        $detail = DB::table('detail_rekam_medis as d')
            ->join('kode_tindakan_terapi as k', 'd.idkode_tindakan_terapi', '=', 'k.idkode_tindakan_terapi')
            ->select(
                'd.iddetail_rekam_medis',
                'k.kode',
                'k.deskripsi_tindakan_terapi',
                'd.detail'
            )
            ->where('d.idrekam_medis', $id)
            ->get();

        return view('dokter.rekam-medis.detail', compact('rekam', 'detail'));
    }

    // Method untuk mulai periksa pasien (dari tombol "Periksa")
public function periksa($idReservasi)
{
    /**
     * =================================================
     * 1. CEK / BUAT REKAM MEDIS
     * =================================================
     */
    $rekam = DB::table('rekam_medis')
        ->where('idreservasi_dokter', $idReservasi)
        ->first();

    if (!$rekam) {

        $temu = DB::table('temu_dokter')
            ->where('idreservasi_dokter', $idReservasi)
            ->first();

        if (!$temu) {
            abort(404, 'Data temu dokter tidak ditemukan');
        }

        $idDokter = DB::table('role_user')
            ->where('idrole_user', $temu->idrole_user)
            ->value('iduser');

        $idrekam_medis = DB::table('rekam_medis')->insertGetId([
            'idreservasi_dokter' => $idReservasi,
            'anamnesa'           => null,
            'temuan_klinis'      => null,
            'diagnosa'           => null,
            'dokter_pemeriksa'   => $idDokter,
            'created_at'         => now(),
        ]);

        $rekam = DB::table('rekam_medis')
            ->where('idrekam_medis', $idrekam_medis)
            ->first();
    }

    /**
     * =================================================
     * 2. AMBIL DATA RESERVASI + PET + PEMILIK + RAS + JENIS
     * =================================================
     */
    $reservasi = DB::table('temu_dokter as td')
        ->join('pet as p', 'td.idpet', '=', 'p.idpet')

        // RAS & JENIS HEWAN (WAJIB)
        ->leftJoin('ras_hewan as rh', 'p.idras_hewan', '=', 'rh.idras_hewan')
        ->leftJoin('jenis_hewan as jh', 'rh.idjenis_hewan', '=', 'jh.idjenis_hewan')

        // PEMILIK (LEWAT TABEL PEMILIK → USER)
        ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
        ->join('user as u', 'pm.iduser', '=', 'u.iduser')

        ->select(
            'td.status',
            'p.nama as nama_pet',
            'u.nama as nama_pemilik',
            'rh.nama_ras',
            'jh.nama_jenis_hewan'
        )
        ->where('td.idreservasi_dokter', $idReservasi)
        ->first();

    // fallback kalau data tidak lengkap
    if (!$reservasi) {
        $reservasi = (object)[
            'status' => '-',
            'nama_pet' => '-',
            'nama_pemilik' => '-',
            'nama_ras' => '-',
            'nama_jenis_hewan' => '-',
        ];
    }

    /**
     * =================================================
     * 3. AMBIL NAMA DOKTER
     * =================================================
     */
    $namaDokter = DB::table('user')
        ->where('iduser', $rekam->dokter_pemeriksa)
        ->value('nama');

    /**
     * =================================================
     * 4. GABUNGKAN DATA (FORMAT SAMA DENGAN showDetail)
     * =================================================
     */
    $rekam = (object) array_merge((array) $rekam, [
        'nama_dokter'        => $namaDokter,
        'status_reservasi'   => $reservasi->status,
        'nama_pet'           => $reservasi->nama_pet,
        'nama_pemilik'       => $reservasi->nama_pemilik,
        'nama_ras'           => $reservasi->nama_ras,
        'nama_jenis_hewan'   => $reservasi->nama_jenis_hewan,
    ]);

    /**
     * =================================================
     * 5. KODE TINDAKAN & DETAIL REKAM MEDIS
     * =================================================
     */
    $kodeTindakan = DB::table('kode_tindakan_terapi')
        ->orderBy('kode')
        ->get();

    $detail = DB::table('detail_rekam_medis as d')
        ->join('kode_tindakan_terapi as k', 'd.idkode_tindakan_terapi', '=', 'k.idkode_tindakan_terapi')
        ->where('d.idrekam_medis', $rekam->idrekam_medis)
        ->select(
            'd.iddetail_rekam_medis',
            'k.kode',
            'k.deskripsi_tindakan_terapi',
            'd.detail'
        )
        ->get();

    /**
     * =================================================
     * 6. RETURN VIEW
     * =================================================
     */
    return view(
        'dokter.rekam-medis.detail-create',
        compact('rekam', 'kodeTindakan', 'detail')
    );
}



}  