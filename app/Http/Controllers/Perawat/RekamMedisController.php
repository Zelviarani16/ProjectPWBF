<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    /**
     * Display a listing of rekam medis
     */
    public function index()
    {
        $rekam = RekamMedis::with([
            'reservasi.pet.pemilik.user',
            'roleUserDokter.user.roles'
        ])->orderBy('idrekam_medis', 'DESC')->get();
        
        return view('perawat.rekam-medis.index', compact('rekam'));
    }

    /**
     * Show the form for creating a new rekam medis
     */
    public function create()
    {
        // Ambil ID reservasi yang SUDAH ada rekam medis
        $reservasiDenganRekamMedis = RekamMedis::pluck('idreservasi_dokter')->toArray();

        // Tampilkan hanya yang:
        // - Status = 'S' (selesai diperiksa)
        // - Belum punya rekam medis
        $reservasi = TemuDokter::select('temu_dokter.*')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->where('temu_dokter.status', 'S') // Hanya yang sudah diperiksa
            ->whereNotIn('temu_dokter.idreservasi_dokter', $reservasiDenganRekamMedis) // Belum ada rekam medis
            ->with(['pet.pemilik.user', 'pet.ras'])
            ->orderBy('temu_dokter.waktu_daftar', 'DESC')
            ->get();

        return view('perawat.rekam-medis.create', compact('reservasi'));
    }

    /**
     * Store a newly created rekam medis
     */
    public function store(Request $request)
    {
        $validated = $this->validateStore($request);

        // $validated = $request->validate([
        //     'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
        //     'anamnesa' => 'required|string|max:1000',
        //     'temuan_klinis' => 'required|string|max:1000',
        //     'diagnosa' => 'required|string|max:1000',
        // ], [
        //     'idreservasi_dokter.required' => 'Reservasi harus dipilih',
        //     'idreservasi_dokter.exists' => 'Reservasi tidak valid',
        //     'anamnesa.required' => 'Anamnesa wajib diisi',
        //     'anamnesa.max' => 'Anamnesa maksimal 1000 karakter',
        //     'temuan_klinis.required' => 'Temuan klinis wajib diisi',
        //     'temuan_klinis.max' => 'Temuan klinis maksimal 1000 karakter',
        //     'diagnosa.required' => 'Diagnosa wajib diisi',
        //     'diagnosa.max' => 'Diagnosa maksimal 1000 karakter',
        // ]);

        // Cek apakah rekam medis untuk reservasi ini sudah ada
        if (RekamMedis::where('idreservasi_dokter', $validated['idreservasi_dokter'])->exists()) {
            return back()->withInput()->with('error', 'Reservasi ini sudah memiliki rekam medis!');
        }

        // Ambil ID dokter dari reservasi (idrole_user)
        $reservasi = TemuDokter::findOrFail($validated['idreservasi_dokter']);
        $validated['dokter_pemeriksa'] = $reservasi->idrole_user;

        // HAPUS baris ini karena kolom tidak ada di tabel
        // $validated['waktu_daftar'] = now(); // HAPUS INI

        // created_at akan otomatis diisi oleh Laravel
        try {
            RekamMedis::create($validated);

            return redirect()->route('perawat.rekam-medis.index')
                            ->with('success', 'Rekam medis berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan rekam medis: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing rekam medis
     */
    public function edit($id)
    {
        $rekam = RekamMedis::with([
            'reservasi.pet.pemilik.user',
            'reservasi.pet.ras.jenisHewan'
        ])->findOrFail($id);
        
        return view('perawat.rekam-medis.edit', compact('rekam'));
    }

    /**
     * Update the specified rekam medis
     */
    public function update(Request $request, $id)
    {
        $validated = $this->validateUpdate($request);

        // $validated = $request->validate([
        //     'anamnesa' => 'required|string|max:1000',
        //     'temuan_klinis' => 'required|string|max:1000',
        //     'diagnosa' => 'required|string|max:1000',
        // ], [
        //     'anamnesa.required' => 'Anamnesa wajib diisi',
        //     'anamnesa.max' => 'Anamnesa maksimal 1000 karakter',
        //     'temuan_klinis.required' => 'Temuan klinis wajib diisi',
        //     'temuan_klinis.max' => 'Temuan klinis maksimal 1000 karakter',
        //     'diagnosa.required' => 'Diagnosa wajib diisi',
        //     'diagnosa.max' => 'Diagnosa maksimal 1000 karakter',
        // ]);

        $rekam = RekamMedis::findOrFail($id);
        $rekam->update($validated);

        return redirect()->route('perawat.rekam-medis.index')
            ->with('success', 'Rekam medis berhasil diperbarui');
    }

    /**
     * Remove the specified rekam medis
     */
    public function destroy($id)
    {
        try {
            $rekam = RekamMedis::findOrFail($id);
            
            // Cek apakah ada detail rekam medis
            if ($rekam->detail()->count() > 0) {
                return back()->with('error', 'Tidak dapat menghapus rekam medis yang memiliki detail tindakan!');
            }
            
            $rekam->delete();
            
            return back()->with('success', 'Rekam medis berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus rekam medis: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified rekam medis detail
     */
    public function showDetail($id)
    {
        $rekam = RekamMedis::with([
            'detail.kodeTindakan',
            'reservasi.pet.pemilik.user',
            'reservasi.pet.ras.jenisHewan',
            'roleUserDokter.user.roles'
        ])->findOrFail($id);

        return view('perawat.rekam-medis.detail', compact('rekam'));
    }

    // ------------------------------------------------------
// VALIDATOR
// ------------------------------------------------------

    private function validateStore(Request $request)
    {
        return $request->validate([
            'idreservasi_dokter' => 'required|exists:temu_dokter,idreservasi_dokter',
            'anamnesa'           => 'required|string|max:1000',
            'temuan_klinis'      => 'required|string|max:1000',
            'diagnosa'           => 'required|string|max:1000',
        ], [
            'idreservasi_dokter.required' => 'Reservasi harus dipilih',
            'idreservasi_dokter.exists'   => 'Reservasi tidak valid',
            'anamnesa.required'           => 'Anamnesa wajib diisi',
            'temuan_klinis.required'      => 'Temuan klinis wajib diisi',
            'diagnosa.required'           => 'Diagnosa wajib diisi',
        ]);
    }

    private function validateUpdate(Request $request)
    {
        return $request->validate([
            'anamnesa'      => 'required|string|max:1000',
            'temuan_klinis' => 'required|string|max:1000',
            'diagnosa'      => 'required|string|max:1000',
        ], [
            'anamnesa.required'      => 'Anamnesa wajib diisi',
            'temuan_klinis.required' => 'Temuan klinis wajib diisi',
            'diagnosa.required'      => 'Diagnosa wajib diisi',
        ]);
    }

}