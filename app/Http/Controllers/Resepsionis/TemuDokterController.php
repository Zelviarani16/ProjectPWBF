<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;

class TemuDokterController extends Controller
{

    // Tampil semua reservasi
    public function index()
    {
        $reservasi = TemuDokter::with(['pet.pemilik.user', 'roleUser.user'])->get();

        return view('resepsionis.temu-dokter.index', compact('reservasi'));
    }

    // Tampil form buat reservasi baru
    public function create()
    {
        $pets = Pet::all();
        $dokters = User::where('role', 2)->get(); // role 2 = dokter
        return view('resepsionis.temu-dokter.create', compact('pets', 'dokters'));
    }

    // Simpan reservasi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_urut' => 'required|integer',
            'waktu_daftar' => 'required|date',
            'status' => 'required|in:A,B,C,D', // contoh status
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:users,id',
        ]);

        TemuDokter::create($validated);

        return redirect()->route('resepsionis.temu-dokter.index')->with('success', 'Reservasi berhasil ditambahkan.');
    }

    // Tampil detail reservasi
    public function show(TemuDokter $temu_dokter)
    {
        return view('resepsionis.temu_dokter.show', compact('temu_dokter'));
    }

    // Tampil form edit reservasi
    public function edit(TemuDokter $temu_dokter)
    {
        $pets = Pet::all();
        $dokters = User::where('role', 2)->get();
        return view('resepsionis.temu_dokter.edit', compact('temu_dokter', 'pets', 'dokters'));
    }

    // Update reservasi
    public function update(Request $request, TemuDokter $temu_dokter)
    {
        $validated = $request->validate([
            'no_urut' => 'required|integer',
            'waktu_daftar' => 'required|date',
            'status' => 'required|in:A,B,C,D',
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:users,id',
        ]);

        $temu_dokter->update($validated);

        return redirect()->route('resepsionis.temu-dokter.index')->with('success', 'Reservasi berhasil diperbarui.');
    }

    // Hapus reservasi
    public function destroy(TemuDokter $temu_dokter)
    {
        $temu_dokter->delete();

        return redirect()->route('resepsionis.temu-dokter.index')->with('success', 'Reservasi berhasil dihapus.');
    }
}
