<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    // Index: tampilkan semua rekam medis
    public function index()
    {
        $rekam = DB::table('rekam_medis as rm')
        ->leftJoin('temu_dokter as td', 'rm.idreservasi_dokter', '=', 'td.idreservasi_dokter')
        ->leftJoin('pet as p', 'td.idpet', '=', 'p.idpet')
        ->leftJoin('user as u', 'p.idpemilik', '=', 'u.iduser') // pemilik hewan
        ->leftJoin('role_user as ru', 'td.idrole_user', '=', 'ru.idrole_user')
        ->leftJoin('user as d', 'ru.iduser', '=', 'd.iduser') // dokter
        ->select(
            'rm.idrekam_medis',
            'rm.idreservasi_dokter',
            'rm.anamnesa',
            'rm.temuan_klinis',
            'rm.diagnosa',
            'td.status',
            'rm.created_at',
            'p.nama as nama_hewan',
            'u.nama as nama_pemilik',
            'd.nama as nama_dokter'
        )
        ->orderByDesc('rm.idrekam_medis')
        ->get();


        return view('perawat.rekam-medis.index', compact('rekam'));
    }

    // Create: form tambah anamnesa
    public function create()
    {
        $reservasiSudahAda = DB::table('rekam_medis')->pluck('idreservasi_dokter')->toArray();

        $reservasi = DB::table('temu_dokter as td')
        ->leftJoin('pet as p', 'td.idpet', '=', 'p.idpet')
        ->leftJoin('user as u', 'p.idpemilik', '=', 'u.iduser') // pemilik
        ->leftJoin('role_user as ru', 'td.idrole_user', '=', 'ru.idrole_user')
        ->leftJoin('dokter as d', 'ru.iduser', '=', 'd.iduser') // dokter
        ->leftJoin('user as du', 'd.iduser', '=', 'du.iduser')   // ambil nama dokter
        ->where('td.status', 'A')
        ->whereNotIn('td.idreservasi_dokter', $reservasiSudahAda)
        ->select(
            'td.idreservasi_dokter',
            'td.waktu_daftar',
            'p.nama as nama_hewan',
            'u.nama as nama_pemilik',
            'du.nama as nama_dokter' // ambil nama dokter
        )
        ->orderBy('td.waktu_daftar', 'DESC')
        ->get();



        // $reservasi = DB::table('temu_dokter as td')
        //     ->leftJoin('pet as p', 'td.idpet', '=', 'p.idpet')
        //     ->leftJoin('user as u', 'p.idpemilik', '=', 'u.iduser')
        //     ->where('td.status', 'A')
        //     ->whereNotIn('td.idreservasi_dokter', $reservasiSudahAda)
        //     ->select(
        //         'td.idreservasi_dokter',
        //         'td.waktu_daftar',
        //         'p.nama as nama_hewan',
        //         'u.nama as nama_pemilik',
        //         'd.nama as nama_dokter'
        //     )
        //     ->orderBy('td.waktu_daftar', 'DESC')
        //     ->get();

        return view('perawat.rekam-medis.create', compact('reservasi'));
    }

    // Store: simpan anamnesa
    public function store(Request $request)
    {
        $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'anamnesa'           => 'required|string|max:1000',
        ]);

        $exists = DB::table('rekam_medis')
            ->where('idreservasi_dokter', $request->idreservasi_dokter)
            ->exists();

        if ($exists) {
            return back()->withInput()->with('error', 'Reservasi ini sudah memiliki rekam medis!');
        }

        // Ambil idrole_user dari temu_dokter
$idRoleUser = DB::table('temu_dokter')
    ->where('idreservasi_dokter', $request->idreservasi_dokter)
    ->value('idrole_user');

    // Ambil iduser (dokter) dari role_user
$idDokter = DB::table('role_user')
    ->where('idrole_user', $idRoleUser)
    ->value('iduser'); // ini id dokter yang nanti disimpan

        // 
        // Insert rekam medis
        DB::table('rekam_medis')->insert([
            'idreservasi_dokter' => $request->idreservasi_dokter,
            'anamnesa'           => $request->anamnesa,
            'dokter_pemeriksa'   => $idDokter,
            'created_at'         => now(),
        ]);

        // Update status reservasi
        DB::table('temu_dokter')
        ->where('idreservasi_dokter', $request->idreservasi_dokter)
        ->update(['status' => 'P']); // 'P' = diproses oleh perawat

        return redirect()->route('perawat.rekam-medis.index')
            ->with('success', 'Anamnesa berhasil ditambahkan. Dokter akan melanjutkan pemeriksaan.');
    }

    // Edit: form edit anamnesa
    public function edit($id)
    {
        $rekam = DB::table('rekam_medis as rm')
            ->leftJoin('temu_dokter as td', 'rm.idreservasi_dokter', '=', 'td.idreservasi_dokter')
            ->leftJoin('pet as p', 'td.idpet', '=', 'p.idpet')
            ->leftJoin('user as u', 'p.idpemilik', '=', 'u.iduser')
            ->select(
                'rm.idrekam_medis',
                'rm.idreservasi_dokter',
                'rm.anamnesa',
                'td.status',
                'p.nama as nama_hewan',
                'u.nama as nama_pemilik'
            )
            ->where('rm.idrekam_medis', $id)
            ->first();

        return view('perawat.rekam-medis.edit', compact('rekam'));
    }

    // Update: simpan perubahan anamnesa
    public function update(Request $request, $id)
    {
        $request->validate([
            'anamnesa' => 'required|string|max:1000',
        ]);

        $rekam = DB::table('rekam_medis as rm')
            ->leftJoin('temu_dokter as td', 'rm.idreservasi_dokter', '=', 'td.idreservasi_dokter')
            ->where('rm.idrekam_medis', $id)
            ->select('rm.*', 'td.status')
            ->first();

        if (in_array($rekam->status, ['SEDANG_DIPERIKSA', 'SELESAI'])) {
            return back()->with('error', 'Anamnesa tidak bisa diedit karena sudah diperiksa dokter.');
        }

        DB::table('rekam_medis')
            ->where('idrekam_medis', $id)
            ->update([
                'anamnesa'   => $request->anamnesa,
                'created_at' => now(),
            ]);

        return redirect()->route('perawat.rekam-medis.index')
            ->with('success', 'Anamnesa berhasil diperbarui.');
    }

    // Detail rekam medis
    public function showDetail($id)
    {
        $rekam = DB::table('rekam_medis as rm')
            ->leftJoin('temu_dokter as td', 'rm.idreservasi_dokter', '=', 'td.idreservasi_dokter')
            ->leftJoin('pet as p', 'td.idpet', '=', 'p.idpet')
            ->leftJoin('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->leftJoin('user as u', 'pm.iduser', '=', 'u.iduser') // pemilik asli
            ->select(
                'rm.*',
                'td.status',
                'p.nama as nama_hewan',
                'u.nama as nama_pemilik'
            )
            ->where('rm.idrekam_medis', $id)
            ->first();


        // Ambil detail tindakan dokter
        $detail = DB::table('detail_rekam_medis as d')
            ->leftJoin('kode_tindakan_terapi as kt', 'd.idkode_tindakan_terapi', '=', 'kt.idkode_tindakan_terapi')
            ->where('d.idrekam_medis', $id)
            ->select(
                'kt.kode', // ini kode T18
                'kt.deskripsi_tindakan_terapi',
                'd.detail'
            )
            ->get();


        return view('perawat.rekam-medis.detail', compact('rekam', 'detail'));
    }
}
