<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TemuDokterController extends Controller
{
    // =========================================================
    // INDEX
    // =========================================================
    public function index()
    {
        $reservasi = TemuDokter::with([
                'pet.pemilik.user',
                'roleUser.user'
            ])
            ->orderBy('waktu_daftar', 'desc')
            ->orderBy('no_urut', 'asc')
            ->get();

        return view('resepsionis.temu-dokter.index', compact('reservasi'));
    }

    // =========================================================
    // CREATE
    // =========================================================
    public function create()
    {
        $pets = Pet::with('pemilik.user')->get();

        // Dokter → role = 2
        $dokters = RoleUser::with('user')
            ->where('idrole', 2)
            ->get();

        return view('resepsionis.temu-dokter.create', compact('pets', 'dokters'));
    }

    // =========================================================
    // STORE
    // =========================================================
    public function store(Request $request)
    {
        $validated = $this->validateCreate($request);

        $today = Carbon::today();

        // BATAS 20 ANTRIAN PER HARI
        $maxPerDay = 20;
        $countToday = TemuDokter::whereDate('waktu_daftar', $today)->count();

        if ($countToday >= $maxPerDay) {
            return back()->with('error', 'Kuota reservasi hari ini sudah penuh.');
        }

        // GENERATE NO URUT PER HARI
        $last = TemuDokter::whereDate('waktu_daftar', $today)
            ->orderBy('no_urut', 'desc')
            ->first();

        $nextNo = $last ? $last->no_urut + 1 : 1;

        TemuDokter::create([
            'no_urut'      => $nextNo,
            'waktu_daftar' => now(),
            'status'       => 'A',
            'idpet'        => $validated['idpet'],
            'idrole_user'  => $validated['idrole_user'],
        ]);

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Reservasi berhasil ditambahkan.');
    }

    // =========================================================
    // EDIT
    // =========================================================
    public function edit($id)
    {
        $reservasi = TemuDokter::with(['pet.pemilik.user', 'roleUser.user'])
            ->findOrFail($id);

        $pets = Pet::with('pemilik.user')->get();
        $dokters = RoleUser::with('user')->where('idrole', 2)->get();

        return view('resepsionis.temu-dokter.edit', compact('reservasi', 'pets', 'dokters'));
    }

    // =========================================================
    // UPDATE
    // =========================================================
    public function update(Request $request, $id)
    {
        $validated = $this->validateUpdate($request);

        $reservasi = TemuDokter::findOrFail($id);

        $reservasi->update([
            'no_urut'      => $validated['no_urut'],
            'status'       => $validated['status'],
            'idpet'        => $validated['idpet'],
            'idrole_user'  => $validated['idrole_user'],
        ]);

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Data reservasi berhasil diperbarui.');
    }

    // =========================================================
    // DELETE
    // =========================================================
    public function destroy($id)
    {
        TemuDokter::findOrFail($id)->delete();

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Reservasi berhasil dihapus.');
    }

    // =========================================================
    // STATUS SELESAI
    // =========================================================
    public function selesai($id)
    {
        $reservasi = TemuDokter::findOrFail($id);
        $reservasi->update(['status' => 'S']);

        return redirect()->route('resepsionis.temu-dokter.index')
            ->with('success', 'Reservasi telah diselesaikan.');
    }

    // =========================================================
    // VALIDATION + HELPERS
    // =========================================================

    private function validateCreate(Request $request)
    {
        return $request->validate([
            'idpet'        => 'required|integer|exists:pet,idpet',
            'idrole_user'  => 'required|integer|exists:role_user,idrole_user',
        ]);
    }

    private function validateUpdate(Request $request)
    {
        return $request->validate([
            'no_urut'      => 'required|integer|min:1',
            'status'       => 'required|in:A,S',
            'idpet'        => 'required|integer|exists:pet,idpet',
            'idrole_user'  => 'required|integer|exists:role_user,idrole_user',
        ]);
    }
}
