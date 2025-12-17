<?php

namespace App\Http\Controllers\Admin;

use App\Models\RasHewan;
use App\Models\JenisHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RasHewanController extends Controller
{
    public function index()
    {
        // $rasHewan = RasHewan::with('jenisHewan')->get();

        $rasHewan = DB::table('ras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select(
                'ras_hewan.*',
                'jenis_hewan.nama_jenis_hewan'
            )
            ->orderBy('ras_hewan.idras_hewan', 'DESC')
            ->get();
            
        return view('admin.ras-hewan.index', compact('rasHewan'));
    }

    public function create()
    {
        // $jenisHewan = JenisHewan::all(); // ambil semua jenis hewan

        // QUERY BUILDER
        $jenisHewan = DB::table('jenis_hewan')->get();

        return view('admin.ras-hewan.create', compact('jenisHewan'));
    }

    public function store(Request $request)
    {
        // panggil method validateRas() yg ada di controller, krn private jd kita pakai $this
        $validated = $this->validateRas($request);

        // Simpan data baru
        // RasHewan::create([
        //     'nama_ras' => $this->formatNamaRas($validated['nama_ras']),
        //     'idjenis_hewan' => $validated['idjenis_hewan'],
        // ]);

        DB::table('ras_hewan')->insert([
            'nama_ras' => $this->formatNamaRas($validated['nama_ras']),
            'idjenis_hewan' => $validated['idjenis_hewan']
        ]);

        return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras hewan berhasil ditambahkan.');
    }

    // ketika klik edit, url akan mengirim id dan di controller ditampilkan datanya sesuai id
    public function edit($id)
    {
        // $rasHewan = RasHewan::findOrFail($id);
        // $jenisHewan = JenisHewan::all();

        $rasHewan = DB::table('ras_hewan')
            ->where('idras_hewan', $id)
            ->first();

        $jenisHewan = DB::table('jenis_hewan')->get();

        return view('admin.ras-hewan.edit', compact('rasHewan', 'jenisHewan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi
        $validated = $this->validateRas($request);

        // Temukan data
        $rasHewan = RasHewan::findOrFail($id);
        
        $rasHewan->update([
            'nama_ras' => $this->formatNamaRas($validated['nama_ras']),
            'idjenis_hewan' => $validated['idjenis_hewan'],
        ]);

        return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras hewan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rasHewan = RasHewan::findOrFail($id);
        $rasHewan->delete();

        return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras hewan berhasil dihapus.');
    }

    // VALIDATION & HELPER

    private function validateRas(Request $request)
    {
        return $request->validate([
            'nama_ras' => 'required|string|max:100',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan', //wajib, dan exists id nya harus ditemukan di tabel jenis hewan, krn yg dikirim dr blade itu id bukan nama nya
        ]);
    }

    private function formatNamaRas($nama_ras)
    {
        return ucwords(strtolower(trim($nama_ras)));
    }
}

