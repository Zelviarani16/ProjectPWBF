<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user', 'pets')->get();
        return view('admin.pemilik.index', compact('pemilik'));
    }

    public function create()
    {
        return view('admin.pemilik.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validatePemilik($request);

        Pemilik::create([
            'nama_pemilik' => $this->formatNama($validated['nama_pemilik']),
            'alamat' => trim($validated['alamat']),
            'no_wa' => $validated['no_wa'],
        ]);

        return redirect()
            ->route('admin.pemilik.index')
            ->with('success', 'Data pemilik berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        return view('admin.pemilik.edit', compact('pemilik'));
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $validated = $this->validatePemilik($request, $id);

        $pemilik->update([
            'nama_pemilik' => $this->formatNama($validated['nama_pemilik']),
            'alamat' => trim($validated['alamat']),
            'no_wa' => $validated['no_wa'],
        ]);

        return redirect()
            ->route('admin.pemilik.index')
            ->with('success', 'Data pemilik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Pemilik::destroy($id);
        return redirect()
            ->route('admin.pemilik.index')
            ->with('success', 'Data pemilik berhasil dihapus.');
    }

    // ======================
    // 💡 VALIDATION & HELPER
    // ======================

    private function validatePemilik(Request $request, $id = null)
    {
        return $request->validate([
            'nama_pemilik' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:500'],
            'no_wa' => [
                'required',
                'string',
                'max:20',
                Rule::unique('pemilik', 'no_wa')->ignore($id, 'idpemilik')
            ],
        ]);
    }

    private function formatNama($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
