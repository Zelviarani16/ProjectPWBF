<?php

namespace App\Http\Controllers\Admin;

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
        return view('admin.pemilik.index', compact('pemilik', 'pemilikTerbaru'));
    }

    public function create()
    {
        // Ambil semua user untuk dropdown
        $users = User::all(); 
        return view('admin.pemilik.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatePemilik($request);

        // Ambil ID terakhir dan tambahkan 1
        $lastPemilik = Pemilik::orderBy('idpemilik', 'DESC')->first();
        $newId = $lastPemilik ? $lastPemilik->idpemilik + 1 : 1;

        Pemilik::create([
            'idpemilik' => $newId,             // ID diisi otomatis
            'iduser' => $validated['iduser'],  // relasi ke user
            'alamat' => trim($validated['alamat']),
            'no_wa' => $this->formatWA($validated['no_wa']),
        ]);

        return redirect()
            ->route('admin.pemilik.index')
            ->with('success', 'Data pemilik berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $users = User::all();
        return view('admin.pemilik.edit', compact('pemilik', 'users'));
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $validated = $this->validatePemilik($request, $id);

        $pemilik->update([
            'alamat' => trim($validated['alamat']),
            'no_wa' => $this->formatWA($validated['no_wa']),
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
            'alamat' => ['required', 'string', 'max:500'],
            'no_wa' => [
                'required',
                'string',
                'max:20',
                Rule::unique('pemilik', 'no_wa')->ignore($id, 'idpemilik')
            ],
        ]);

        // Hanya tambahkan iduser saat create (bukan update)
        if ($id === null) {
            $rules['iduser'] = ['required', 'exists:user,iduser'];
        }

        return $request->validate($rules);
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
