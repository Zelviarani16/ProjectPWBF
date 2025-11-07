<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Default redirect kalau role tidak ditemukan

    public function __construct()
    {
        // Guest hanya boleh mengakses form login kalau belum login.
        // Auth hanya boleh logout kalau sudah login.
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input login
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Cek user berdasarkan email
        $user = User::with(['roleUser' => function ($query) {
            $query->where('status', 1);
        }, 'roleUser.role'])
        ->where('email', $request->input('email'))
        ->first();

        if (!$user) {
            return redirect()->back()
                ->withErrors(['email' => 'Email tidak ditemukan.'])
                ->withInput();
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors(['password' => 'Password salah.'])
                ->withInput();
        }

        // Ambil data role user
        $roleId = $user->roleUser[0]->idrole ?? null;
        $namaRole = Role::where('idrole', $roleId)->first();

        // Login user ke session
        Auth::login($user);

        // Simpan data penting ke session
        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->nama,
            'user_email' => $user->email,
            'user_role_id' => $roleId, // 🔹 Tambahan untuk home.blade.php
            // Simpan role id ke session, maka nilainya bisa diakses di semua halaman setelah login, bahkan setelah reload
            'user_role' => $roleId,
            'user_role_name' => $namaRole->nama_role ?? 'User',
            'user_status' => $user->roleUser[0]->status ?? 'active'
        ]);

        // Redirect sesuai role
        switch ($roleId) {
            case 1:
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil!');
            case 2:
                return redirect()->route('dokter.dashboard')->with('success', 'Login berhasil!');
            case 3:
                return redirect()->route('perawat.dashboard')->with('success', 'Login berhasil!');
            case 4:
                return redirect()->route('resepsionis.dashboard')->with('success', 'Login berhasil!');
            case 5:
                return redirect()->route('pemilik.dashboard')->with('success', 'Login berhasil!');
            default:
                return redirect('/')->with('error', 'Role tidak valid!');
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }
}
