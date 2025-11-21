<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $kodeTindakanTerapi = DB::table('kode_tindakan_terapi as ktt')
            ->join('kategori as k', 'ktt.idkategori', '=', 'k.idkategori')
            ->join('kategori_klinis as kk', 'ktt.idkategori_klinis', '=', 'kk.idkategori_klinis')
            ->select(
                'ktt.*',
                'k.nama_kategori',
                'kk.nama_kategori_klinis'
            )
            ->orderBy('ktt.idkode_tindakan_terapi', 'ASC')
            ->get();
            
        // $kodeTindakanTerapi = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        return view('admin.kode-tindakan-terapi.index', compact('kodeTindakanTerapi'));
    }

    public function create()
    {
        $kategori = DB::table('kategori')->get();
        $kategoriKlinis = DB::table('kategori_klinis')->orderBy('nama_kategori_klinis')->get();

        // $kategori = Kategori::all();
        // $kategoriKlinis = KategoriKlinis::all();
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

        // KodeTindakanTerapi::create($validated);

        // INSERT QUERY BUILDER
        DB::table('kode_tindakan_terapi')->insert([
            'kode' => $validated['kode'],
            'deskripsi_tindakan_terapi' => $validated['deskripsi_tindakan_terapi'],
            'idkategori' => $validated['idkategori'],
            'idkategori_klinis' => $validated['idkategori_klinis'],
        ]);

        return redirect()->route('admin.kode-tindakan-terapi.index')
                         ->with('success', 'Kode tindakan terapi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);

        // Ambil data kode tindakan terapi berdasarkan id
        $kodeTindakanTerapi = DB::table('kode_tindakan_terapi')
            ->where('idkode_tindakan_terapi', $id)
            ->first();

        // $kategori = Kategori::all();
        // $kategoriKlinis = KategoriKlinis::all()

        if (!$kodeTindakanTerapi) {
            abort(404);
        }

        // Ambil kategori & klini
        $kategori = DB::table('kategori')->orderBy('nama_kategori')->get();
        $kategoriKlinis = DB::table('kategori_klinis')->orderBy('nama_kategori_klinis')->get();


        return view('admin.kode-tindakan-terapi.edit', compact('kodeTindakanTerapi', 'kategori', 'kategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        // $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);

        $validated = $request->validate([
            'kode' => 'required|string|max:5|unique:kode_tindakan_terapi,kode,' . $id . ',idkode_tindakan_terapi',
            'deskripsi_tindakan_terapi' => 'required|string|max:1000',
            'idkategori' => 'required|exists:kategori,idkategori',
            'idkategori_klinis' => 'required|exists:kategori_klinis,idkategori_klinis',
        ]);

        // $kodeTindakanTerapi->update($validated);

        // UPDATE Query Builder
        DB::table('kode_tindakan_terapi')
            ->where('idkode_tindakan_terapi', $id)
            ->update([
                'kode' => $validated['kode'],
                'deskripsi_tindakan_terapi' => $validated['deskripsi_tindakan_terapi'],
                'idkategori' => $validated['idkategori'],
                'idkategori_klinis' => $validated['idkategori_klinis'],
            ]);

        return redirect()->route('admin.kode-tindakan-terapi.index')
                         ->with('success', 'Kode tindakan terapi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // $kodeTindakanTerapi = KodeTindakanTerapi::findOrFail($id);
        // $kodeTindakanTerapi->delete();

        DB::table('kode_tindakan_terapi')
            ->where('idkode_tindakan_terapi', $id)
            ->delete();

        return redirect()->route('admin.kode-tindakan-terapi.index')
                         ->with('success', 'Kode tindakan terapi berhasil dihapus.');
    }
}
