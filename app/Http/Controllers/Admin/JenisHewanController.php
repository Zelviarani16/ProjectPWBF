<?php

namespace App\Http\Controllers\Admin;

use App\Models\JenisHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

// QUERY BUILDER 
// get() -> RETURNS: illuminate\Support\Collection

// Query builder sudah membungkus hasil query menjadi collection

class JenisHewanController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel jenis_hewan lewat model
        // $jenisHewan = JenisHewan::all();

        $jenisHewan = DB::table('jenis_hewan')->get();
        // Kirim data ke view blade
        return view('admin.jenis-hewan.index', compact('jenisHewan'));
    }

    public function create()
    {
        return view('admin.jenis-hewan.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateJenisHewan($request);

        // Simpan data baru
        // JenisHewan::create([
        //     'nama_jenis_hewan' => $this->formatNamaJenisHewan($validated['nama_jenis_hewan']),
        // ]);

        DB::table('jenis_hewan')->insert([
            'nama_jenis_hewan' => $this->formatNamaJenisHewan($validated['nama_jenis_hewan']),
        ]);

        return redirect()->route('admin.jenis-hewan.index')
                        ->with('success', 'Jenis hewan berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        // $jenisHewan = JenisHewan::findOrFail($id);

        $jenisHewan = DB::table('jenis_hewan')
                        ->where('idjenis_hewan', $id)
                        ->first();

        return view('admin.jenis-hewan.edit', compact('jenisHewan'));
    }

    // public function update(Request $request, string $id)
    // {
    //     $validated = $this->validateJenisHewan($request);

    //     // Temukan data
    //     $jenisHewan = jenisHewan::findOrFail($id);

    //     $jenisHewan->update([
    //         'nama_jenis_hewan' => $this->formatNamaJenisHewan($validated['nama_jenis_hewan']),
    //     ]);

    //     return redirect()->route('admin.jenis-hewan.index')
    //                     ->with('success', 'Jenis hewan berhasil diperbarui!');
    // }

    public function update(Request $request, $id)
    {
        $validated = $this->validateJenisHewan($request, $id);

        DB::table('jenis_hewan')
            ->where('idjenis_hewan', $id)
            ->update([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($validated['nama_jenis_hewan']),
            ]);

        return redirect()->route('admin.jenis-hewan.index')->with('success', 'Jenis hewan berhasil diperbarui!');
    }

    // public function destroy(string $id)
    // {
    //     $jenisHewan = JenisHewan::findOrFail($id);
    //     $jenisHewan->delete();

    //     return redirect()->route('admin.jenis-hewan.index')
    //                     ->with('success', 'Jenis hewan berhasil dihapus!');
    // }

    public function destroy($id)
    {
        DB::table('jenis_hewan')->where('idjenis_hewan', $id)->delete();

        return redirect()->route('admin.jenis-hewan.index')->with('success', 'Jenis hewan berhasil dihapus!');
    }


// VALIDATION & HELPER

// private function validateJenisHewan(Request $request)
// {
//     return $request->validate([
//         'nama_jenis_hewan' => 'required|string|max:100|unique:jenis_hewan,nama_jenis,' . ($request->idjenis_hewan ?? '') . ',idjenis_hewan',
//     ]);
// }


    private function validateJenisHewan(Request $request, $id = null)
    {
        return $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100|unique:jenis_hewan,nama_jenis_hewan,' . ($id ?? '') . ',idjenis_hewan',
        ]);
    }

    private function formatNamaJenisHewan($nama)
    {

        return ucwords(strtolower(trim($nama)));
    }

}