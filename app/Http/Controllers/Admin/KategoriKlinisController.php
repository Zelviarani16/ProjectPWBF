<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        // $kategoriKlinis = KategoriKlinis::orderBy('idkategori_klinis', 'ASC')->get();

        $kategoriKlinis = DB::table('kategori_klinis')
            ->orderBy('idkategori_klinis', 'ASC')
            ->get();

        return view('admin.kategori-klinis.index', compact('kategoriKlinis'));
    }

    public function create()
    {
        return view('admin.kategori-klinis.create');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'nama_kategori_klinis' => 'required|string|max:50|unique:kategori_klinis,nama_kategori_klinis'
        // ]);

        $validated = $this->validateKategoriKlinis($request);

        $lastId = DB::table('kategori_klinis')->max('idkategori_klinis');
        $nextId = $lastId ? $lastId + 1 : 1;

        // KategoriKlinis::create([
        //     'idkategori_klinis' => $nextId,
        //     'nama_kategori_klinis' => $request->nama_kategori_klinis,
        // ]);

        DB::table('kategori_klinis')->insert([
            'idkategori_klinis' => $nextId,
            'nama_kategori_klinis' => $this->formatNamaKategoriKlinis($validated['nama_kategori_klinis'])
        ]);

        return redirect()->route('admin.kategori-klinis.index')
            ->with('success', 'Kategori klinis berhasil ditambahkan.');
    }

    public function edit($id)
    {

        $kategori = DB::table('kategori_klinis')
            ->where('idkategori_klinis', $id)
            ->first();

        return view('admin.kategori-klinis.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {

        $validated = $this->validateKategoriKlinis($request, $id);

        // $request->validate([
        //     'nama_kategori_klinis' => 'required|string|max:50|unique:kategori_klinis,nama_kategori_klinis,'.$id.',idkategori_klinis'
        // ]);

        DB::table('kategori_klinis')->where('idkategori_klinis', $id)->update([
            'nama_kategori_klinis' => $this->formatNamaKategoriKlinis($validated['nama_kategori_klinis']),
        ]);

        // $kategori = KategoriKlinis::findOrFail($id);
        // $kategori->update([
        //     'nama_kategori_klinis' => $request->nama_kategori_klinis,
        // ]);

        return redirect()->route('admin.kategori-klinis.index')
                         ->with('success', 'Kategori klinis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('kategori_klinis')->where('idkategori_klinis', $id)->delete();
        // $kategori = KategoriKlinis::findOrFail($id);
        // $kategori->delete();

        return redirect()->route('admin.kategori-klinis.index')
                         ->with('success', 'Kategori klinis berhasil dihapus.');
    }

    // VALIDATION DAN HELPER
    private function validateKategoriKlinis(Request $request, $id = null)
    {
        return $request->validate([
            'nama_kategori_klinis' => 'required|string|max:100|unique:kategori_klinis,nama_kategori_klinis,' . $id . ',idkategori_klinis',
        ]);
    }
            
    private function formatNamaKategoriKlinis($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
