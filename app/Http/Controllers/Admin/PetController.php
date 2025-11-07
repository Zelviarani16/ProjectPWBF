<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with(['pemilik', 'rasHewan'])->get();
        return view('admin.pet.index', compact('pets'));
    }

    public function create()
    {
        $pemilik = Pemilik::with('user')->get();
        $rasHewan = RasHewan::all();
        return view('admin.pet.create', compact('pemilik', 'rasHewan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'warna_tanda' => 'nullable|string|max:45',
            'jenis_kelamin' => 'required|in:L,P',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ]);

        Pet::create($validated);

        return redirect()->route('admin.pet.index')
                         ->with('success', 'Data pet berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        $pemilik = Pemilik::all();
        $rasHewan = RasHewan::all();
        return view('admin.pet.edit', compact('pet', 'pemilik', 'rasHewan'));
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'warna_tanda' => 'nullable|string|max:45',
            'jenis_kelamin' => 'required|in:L,P',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
        ]);

        $pet->update($validated);

        return redirect()->route('admin.pet.index')
                         ->with('success', 'Data pet berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();

        return redirect()->route('admin.pet.index')
                         ->with('success', 'Data pet berhasil dihapus.');
    }
}
