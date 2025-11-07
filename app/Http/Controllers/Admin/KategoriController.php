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
        $kategori = Kategori::all(); // Ambil semua kategori
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

        Kategori::create([
            'idkategori' => $nextId,
            'nama_kategori' => $this->formatNamaKategori($validated['nama_kategori']),
        ]);

        return redirect()->route('admin.kategori.index')
                        ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateKategori($request);

        $kategori = Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $this->formatNamaKategori($validated['nama_kategori']),
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }

    // Validation & Helper
    private function validateKategori(Request $request)
    {
        return $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori,' . ($request->idkategori ?? '') . ',idkategori',
        ]);
    }

    private function formatNamaKategori($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
