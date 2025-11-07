<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Menampilkan semua user tanpa relasi role (karena kamu bilang ini hanya user)
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        // Form kosong, tidak ada data dikirim
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $this->validateUser($request);

        // Simpan user baru
        User::create([
            'nama' => $this->formatNama($validated['nama']),
            'email' => strtolower(trim($validated['email'])),
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus.');
    }

    //  HELPER & VALIDATION

    private function validateUser(Request $request)
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6|same:retype_password',
            'retype_password' => 'required|min:6',
        ]);
    }

    private function formatNama($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
