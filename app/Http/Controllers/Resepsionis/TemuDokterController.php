<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;

class TemuDokterController extends Controller
{
    // Menampilkan semua reservasi
    public function index()
    {
        $reservasiList = TemuDokter::with(['pet.pemilik.user', 'dokter.user'])
            ->orderBy('no_urut', 'asc')
            ->get();

        return view('resepsionis.temu-dokter.index', compact('reservasiList'));
    }

    // Menampilkan form tambah reservasi
    public function create()
    {
        $pemilikList = User::whereHas('pemilik', fn($q) => $q)->get(); // Hanya user yang punya pemilik
        $pets = Pet::all();
        $dokters = User::whereHas('roles', fn($q) => $q->where('nama_role', 'dokter'))->get();

        return view('resepsionis.temu-dokter.create', compact('pemilikList', 'pets', 'dokters'));
    }

    // Simpan reservasi baru
    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pets,idpet',
            'iduser_dokter' => 'required|exists:users,iduser',
            'status' => 'required|string|in:P,C,S', // contoh: P=Pending, C=Confirmed, S=Selesai
        ]);

        $temu = new TemuDokter();
        $temu->idpet = $request->idpet;
        $temu->idrole_user = $temu->resolveRoleUserId($request->iduser_dokter);
        $temu->no_urut = TemuDokter::max('no_urut') + 1; // auto nomor urut
        $temu->status = $request->status;
        $temu->save();

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Reservasi Temu Dokter berhasil ditambahkan');
    }

    // Menampilkan form edit reservasi
    public function edit($id)
    {
        $temu = TemuDokter::findOrFail($id);
        $pets = Pet::all();
        $dokters = User::whereHas('roles', fn($q) => $q->where('nama_role', 'dokter'))->get();

        return view('resepsionis.temu-dokter.edit', compact('temu', 'pets', 'dokters'));
    }

    // Update reservasi
    public function update(Request $request, $id)
    {
        $request->validate([
            'idpet' => 'required|exists:pets,idpet',
            'iduser_dokter' => 'required|exists:users,iduser',
            'status' => 'required|string|in:P,C,S',
        ]);

        $temu = TemuDokter::findOrFail($id);
        $temu->idpet = $request->idpet;
        $temu->idrole_user = $temu->resolveRoleUserId($request->iduser_dokter);
        $temu->status = $request->status;
        $temu->save();

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Reservasi Temu Dokter berhasil diupdate');
    }

    // Hapus reservasi
    public function destroy($id)
    {
        $temu = TemuDokter::findOrFail($id);
        $temu->delete();

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Reservasi Temu Dokter berhasil dihapus');
    }
}
