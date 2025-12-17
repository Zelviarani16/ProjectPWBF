<?php

namespace App\Http\Controllers\Resepsionis;

use App\Models\User;
use App\Models\Pemilik;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user', 'pets')->get();
        $pemilikTerbaru = Pemilik::orderBy('idpemilik', 'DESC')->first();
        return view('resepsionis.pemilik.index', compact('pemilik', 'pemilikTerbaru'));
    }

    public function create()
    {
        // Ambil semua user untuk dropdown
        $users = User::all(); 
        return view('resepsionis.pemilik.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatePemilik($request);

        $lastId = Pemilik::max('idpemilik') ?? 0;

        Pemilik::create([
            'idpemilik' => $lastId + 1,
            'iduser' => $validated['iduser'], // relasi ke user
            'alamat' => trim($validated['alamat']),
            'no_wa' => $validated['no_wa'],
        ]);

        return redirect()
            ->route('resepsionis.pemilik.index')
            ->with('success', 'Data pemilik berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $users = User::all();
        return view('resepsionis.pemilik.edit', compact('pemilik', 'users'));
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $validated = $this->validatePemilik($request, $id);

        $pemilik->update([
            'iduser' => $validated['iduser'],
            'alamat' => trim($validated['alamat']),
            'no_wa' => $this->formatWA($validated['no_wa']),
        ]);

        return redirect()
            ->route('resepsionis.pemilik.index')
            ->with('success', 'Data pemilik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Pemilik::destroy($id);
        return redirect()
            ->route('resepsionis.pemilik.index')
            ->with('success', 'Data pemilik berhasil dihapus.');
    }

    // ======================
    // 💡 VALIDATION & HELPER
    // ======================

    private function validatePemilik(Request $request, $id = null)
    {
        return $request->validate([
            'iduser' => ['required', 'exists:user,iduser'], // pilih user terkait
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

    // Helper untuk format nomor WA ()
    private function formatWA($no_wa)
    {
        return preg_replace('/\D/', '', $no_wa); // hapus karakter non-digit
    }
}
