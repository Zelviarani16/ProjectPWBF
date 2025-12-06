<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RasHewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PetController extends Controller
{
    public function index()
    {
        $pets = DB::table('pet as p')
            ->join('pemilik as pm', 'p.idpemilik', '=', 'pm.idpemilik')
            ->join('user as u', 'pm.iduser', '=', 'u.iduser')
            ->join('ras_hewan as rh', 'p.idras_hewan', '=', 'rh.idras_hewan')
            ->select(
                'p.*',
                'u.nama as nama_pemilik',
                'rh.nama_ras'
            )
            // pakai alias p karena di DB::table sudah di as kan 'p'
            ->orderBy('p.idpet', 'ASC')
            ->get();

        return view('admin.pet.index', compact('pets'));
    }

    public function create()
    {
        $rasHewan = RasHewan::all();

        $pemilik = DB::table('pemilik as pm')
            ->leftJoin('user as u', 'pm.iduser', '=', 'u.iduser')
            ->select('pm.*', 'u.nama as nama_user')
            ->get();

        return view('admin.pet.create', compact('pemilik', 'rasHewan'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatePet($request);

        DB::table('pet')->insert([
            'nama'          => $this->formatNama($validated['nama']),
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'warna_tanda'   => $validated['warna_tanda'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'idpemilik'     => $validated['idpemilik'],
            'idras_hewan'   => $validated['idras_hewan'],
        ]);

        return redirect()->route('admin.pet.index')
                         ->with('success', 'Data pet berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pet = Pet::findOrFail($id);

        // Ambil pemilik dengan join ke user supaya ada nama_user
        $pemilik = DB::table('pemilik as pm')
            ->leftJoin('user as u', 'pm.iduser', '=', 'u.iduser')
            ->select('pm.*', 'u.nama as nama_user')
            ->get();

        $rasHewan = RasHewan::all();

        return view('admin.pet.edit', compact('pet', 'pemilik', 'rasHewan'));
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        $validated = $this->validatePet($request);

        $pet->update([
            'nama'          => $this->formatNama($validated['nama']),
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'warna_tanda'   => $validated['warna_tanda'] ?? null,
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'idpemilik'     => $validated['idpemilik'],
            'idras_hewan'   => $validated['idras_hewan'],
        ]);

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

    // -------------------------------
    // Validation & Helper
    // -------------------------------

    private function validatePet(Request $request)
    {
        return $request->validate([
            'nama'          => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'warna_tanda'   => 'nullable|string|max:45',
            'jenis_kelamin' => [
                'required',
                function($attribute, $value, $fail) {
                    if (!in_array(trim($value), ['L','P'])) {
                        $fail("The selected $attribute is invalid.");
                    }
                }
            ],
            'idras_hewan'   => 'required|integer|exists:ras_hewan,idras_hewan',
            'idpemilik'     => 'required|integer|exists:pemilik,idpemilik',
        ]);
    }

    private function formatNama($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
