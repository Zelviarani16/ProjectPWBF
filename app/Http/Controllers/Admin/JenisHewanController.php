<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use Illuminate\Http\Request;

class JenisHewanController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel jenis_hewan lewat model
        $jenisHewan = JenisHewan::all();
        // Kirim data ke view blade
        return view('admin.jenis-hewan.index', compact('jenisHewan'));
    }

    public function create()
    {
        return view('admin.jenis-hewan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100',
        ]);

        JenisHewan::create([
            'nama_jenis_hewan' => $request->nama_jenis_hewan,
        ]);

        return redirect()->route('admin.jenis-hewan.index')
                        ->with('success', 'Jenis hewan berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        return view('admin.jenis-hewan.show', compact('jenisHewan'));
    }

    public function edit(string $id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        return view('admin.jenis-hewan.edit', compact('jenisHewan'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100',
        ]);

        $jenisHewan = JenisHewan::findOrFail($id);
        $jenisHewan->update([
            'nama_jenis_hewan' => $request->nama_jenis_hewan,
        ]);

        return redirect()->route('admin.jenis-hewan.index')
                        ->with('success', 'Jenis hewan berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $jenisHewan = JenisHewan::findOrFail($id);
        $jenisHewan->delete();

        return redirect()->route('admin.jenis-hewan.index')
                        ->with('success', 'Jenis hewan berhasil dihapus!');
    }
}
