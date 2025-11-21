<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB; 

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = DB::table('kategori')->get();// Ambil semua kategori
        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateKategori($request);

        // Generate idkategori manual
        $lastId = DB::table('kategori')->max('idkategori');
        $nextId = $lastId ? $lastId + 1 : 1;

        DB::table('kategori')->insert([
            'idkategori' => $nextId,
            'nama_kategori' => $this->formatNamaKategori($validated['nama_kategori'])
        ]);

        // Kategori::create([
        //     'idkategori' => $nextId,
        //     'nama_kategori' => $this->formatNamaKategori($validated['nama_kategori']),
        // ]);

        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = DB::table('kategori')->where('idkategori', $id)->first();
        // $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateKategori($request, $id);

        // $validated = $this->validateKategori($request);

        DB::table('kategori')->where('idkategori', $id)->update([
        // $kategori = Kategori::findOrFail($id);
        // $kategori->update([
            'nama_kategori' => $this->formatNamaKategori($validated['nama_kategori']),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        DB::table('kategori')->where('idkategori', $id)->delete();
        // $kategori = Kategori::findOrFail($id);
        // $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

    // Validation & Helper
    private function validateKategori(Request $request, $id = null)
    {
        // return $request->validate([
        //     'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori,' . ($request->idkategori ?? '') . ',idkategori',
        // ]);
        return $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori,' . $id . ',idkategori',
        ]);
    }

    private function formatNamaKategori($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
