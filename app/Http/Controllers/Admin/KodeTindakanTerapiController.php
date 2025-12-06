<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakanTerapi;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;

class KodeTindakanTerapiController extends Controller
{
    // =========================================================
    // INDEX
    // =========================================================
    public function index()
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])
            ->orderBy('idkode_tindakan_terapi', 'ASC')
            ->get();

        return view('admin.kode-tindakan-terapi.index', compact('kodeTindakanTerapi'));
    }

    // =========================================================
    // CREATE
    // =========================================================
    public function create()
    {
        $kategori = Kategori::orderBy('nama_kategori')->get();
        $kategoriKlinis = KategoriKlinis::orderBy('nama_kategori_klinis')->get();

        return view('admin.kode-tindakan-terapi.create', compact('kategori', 'kategoriKlinis'));
    }

    // =========================================================
    // STORE
    // =========================================================
    public function store(Request $request)
    {
        $validated = $this->validateForm($request);

        KodeTindakanTerapi::create($validated);

        return redirect()->route('admin.kode-tindakan-terapi.index')
            ->with('success', 'Kode tindakan terapi berhasil ditambahkan.');
    }

    // =========================================================
    // EDIT
    // =========================================================
    public function edit($id)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);

        $kategori = Kategori::orderBy('nama_kategori')->get();
        $kategoriKlinis = KategoriKlinis::orderBy('nama_kategori_klinis')->get();

        return view('admin.kode-tindakan-terapi.edit',
            compact('kodeTindakanTerapi', 'kategori', 'kategoriKlinis')
        );
    }

    // =========================================================
    // UPDATE
    // =========================================================
    public function update(Request $request, $id)
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);

        $validated = $this->validateForm($request, $id);

        $kodeTindakanTerapi->update($validated);

        return redirect()->route('admin.kode-tindakan-terapi.index')
            ->with('success', 'Kode tindakan terapi berhasil diperbarui.');
    }

    // =========================================================
    // DELETE
    // =========================================================
    public function destroy($id)
    {
        KodeTindakanTerapi::findOrFail($id)->delete();

        return redirect()->route('admin.kode-tindakan-terapi.index')
            ->with('success', 'Kode tindakan terapi berhasil dihapus.');
    }

    // =========================================================
    // VALIDATION
    // =========================================================
    private function validateForm(Request $request, $id = null)
    {
        return $request->validate([
            'kode' => 'required|string|max:5|unique:kode_tindakan_terapi,kode,' .
                ($id ?? 'NULL') . ',idkode_tindakan_terapi',

            'deskripsi_tindakan_terapi' => 'required|string|max:1000',

            'idkategori' => 'required|exists:kategori,idkategori',

            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ]);
    }
}
