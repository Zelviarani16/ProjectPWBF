<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        return view('admin.kode-tindakan-terapi.index', compact('kodeTindakanTerapi'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kode-tindakan-terapi.create', compact('kategori', 'kategoriKlinis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:5|unique:kode_tindakan_terapi,kode',
            'deskripsi_tindakan_terapi' => 'required|string|max:1000',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ]);

        KodeTindakanTerapi::create($validated);

        return redirect()->route('admin.kode-tindakan-terapi.index')
                         ->with('success', 'Kode tindakan terapi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kode-tindakan-terapi.edit', compact('kodeTindakanTerapi', 'kategori', 'kategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);

        $validated = $request->validate([
            'kode' => 'required|string|max:5|unique:kode_tindakan_terapi,kode,' . $id . ',idkode_tindakan_terapi',
            'deskripsi_tindakan_terapi' => 'required|string|max:1000',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ]);

        $kodeTindakanTerapi->update($validated);

        return redirect()->route('admin.kode-tindakan-terapi.index')
                         ->with('success', 'Kode tindakan terapi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);
        $kodeTindakanTerapi->delete();

        return redirect()->route('admin.kode-tindakan-terapi.index')
                         ->with('success', 'Kode tindakan terapi berhasil dihapus.');
    }
}
