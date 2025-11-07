<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RasHewan;
use App\Models\JenisHewan;
use Illuminate\Http\Request;

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = RasHewan::with('jenisHewan')->get();
        return view('admin.ras-hewan.index', compact('rasHewan'));
    }

    public function create()
    {
        $jenisHewan = JenisHewan::all(); // ambil semua jenis hewan

        return view('admin.ras-hewan.create', compact('jenisHewan'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRas($request);

        // Simpan data baru
        RasHewan::create([
            'nama_ras' => $this->formatNamaRas($validated['nama_ras']),
            'idjenis_hewan' => $validated['idjenis_hewan'],


        ]);

        return redirect()->route('admin.ras-hewan.index')->with('success', 'Ras hewan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $rasHewan = RasHewan::findOrFail($id);
        $jenisHewan = JenisHewan::all();

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
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ]);
    }

    private function formatNamaRas($nama_ras)
    {
        return ucwords(strtolower(trim($nama_ras)));
    }

}

