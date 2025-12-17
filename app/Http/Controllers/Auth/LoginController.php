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

        // Tujuannya untuk mencegah user yg sudah login membuka ulang halaman login
    }

    // showLoginForm: menampilkan form login (namanya otomatis dr laravel ui) hasil dari form GET
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Terima (menangkap) data dari form login POST menjadi object $request
    // $request -> data yg dikirim dari browser ke server
    public function login(Request $request)
    {
        // Validasi input login
        // $request->all yg dikirim adalah semua yg punya name="", termasuk token dan remember me di blade. tetapi disini hanya ditulis email dan password krn yg mau kita validasi cukup ini, yg lain biarkan
        // Kalau validasi gagal, kembali ke /login dan tetap menyimpan error ke session dalam bentuk errors = { email ="Email harus valid" .... }
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Validator gagal (fails) jg bawaan laravel
        if ($validator->fails()) {
            return redirect()->back()
            // Ambil semua pesan error dari validator, simpan ke session dan tampilkan di blade
                ->withErrors($validator)
            // Laravel menyimpan input lama ke session, supaya form terisi ulang waktu ada error. 
            // Di blade kamu:
            // value="{{ old('email') }}"
            // Itulah input lama yang dikirim balik dari session.
                ->withInput();
        }

        // Cek user berdasarkan email, tp $user tetap menyimpan semua data
        // User:: sama dengan select * from user
        $user = User::with(['roleUser' => function ($query) {
            $query->where('status', 1);
        }, 'roleUser.role']) // Ambil nama role dari tabel role
        ->where('email', $request->input('email')) // ambil email yg diketik user
        ->first();

        // Simpan error ke session dan ditampilkan di blade via @error
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

        // Ambil data role user (roleUser relasi di models)
        $roleId = $user->roleUser->idrole ?? null;
        $namaRole = Role::where('idrole', $roleId)->first();

        // Login user ke session
        // SAAT USER SUDAH LOGIN (berhasil login, setelah diperiksa email dan pw, sebelumnya user blm login dan baru dicek email ada dan password sesuai)
        Auth::login($user);

        // SIMPAN DATA KE SESSION
        $request->session()->put([
            'user_id' => $user->iduser,
            'user_name' => $user->nama,
            'user_email' => $user->email,
            'user_role_id' => $roleId, // 🔹 Tambahan untuk home.blade.php
            // Simpan role id ke session, maka nilainya bisa diakses di semua halaman setelah login, bahkan setelah reload
            'user_role' => $roleId,
            'user_role_name' => $namaRole->nama_role ?? 'User',
            'user_status' => $user->roleUser->status ?? 'active'
        ]);

        // Redirect sesuai role
        switch ($roleId) {
            // kembali ke web.php utk menemukan route misal /admin/dashboard -> middleware auth + isadministrator dijalankan
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

        $request->session()->invalidate(); // hapus semua session
        $request->session()->regenerateToken(); // buat csrf baru

        return redirect('/')->with('success', 'Logout berhasil!');

        // Ketika user logout:
            // session auth dihapus
            // semua session user dibuang
            // token csrf diperbarui
            // redirect ke halaman utama
    }
}





// [User Belum Login] 
//         |
//         v
//    Navbar menampilkan: 
//    @guest → Login
//         |
//         | Klik "Login"
//         v
// [GET /login] → LoginController@showLoginForm
//         |
//         v
//    Tampil form login (Blade)
//         |
//         | Submit form
//         v
// [POST /login] → LoginController@login
//         |
//         | Validasi email/password
//         v
//   Jika gagal → redirect back + error (session) → form tetap terisi (old input)
//   Jika berhasil → Auth::login($user) → simpan session
//         |
//         v
// [User Login Berhasil] → redirect ke dashboard sesuai role
//         |
//         v
//    Navbar otomatis berubah:
//    @auth → Logout {{ Auth::user()->name }}
//    @guest → tidak tampil
//         |
//         | Klik "Logout"
//         v
// [POST /logout] → LoginController@logout
//         |
//         | Hapus session Auth
//         v
// [User Logout] → redirect ke halaman awal
//         |
//         v
//    Navbar otomatis berubah lagi:
//    @guest → Login
//    @auth → tidak tampil




// Klik navbar Login → browser request GET /login

// Laravel buat token CSRF (jika belum ada) → simpan di session server

// Token ini juga disisipkan ke form login sebagai hidden input (@csrf)

// Tampil form login

// Form <input type="hidden" name="_token" value="xyz123"> → token sama persis dengan yang di session

// Klik tombol Login di form → browser kirim POST /login

// Form mengirim data email, password, dan _token (token yang ada di hidden input)

// Laravel otomatis mengecek _token vs token yang tersimpan di session (VerifyCsrfToken middleware)

// Jika cocok → request diteruskan ke LoginController@login

// Jika tidak cocok → Laravel blok request dengan 419 error (Page Expired)

// Jadi token tidak “baru” saat submit, tapi token yang dikirim di form harus sama dengan token di session.



// [Browser] Klik "Login" di Navbar
//         │
//         ▼
// [Route /login GET] (web.php)
//         │
//         ▼
// LoginController@showLoginForm
//         │
//         ▼
// Blade login form tampil
//         │  (CSRF token otomatis disisipkan di <input type="hidden">)
//         ▼
// [User] Isi email & password → Submit
//         │
//         ▼
// [Route /login POST] (web.php)
//         │
//         ▼
// LoginController@login
//         │
//         ├─ Validasi email & password
//         │       │
//         │       ├─ Gagal → redirect back + error session
//         │       │
//         │       └─ Berhasil → Auth::login($user) + simpan session:
//         │            - user_id, user_name, user_email
//         │            - user_role, user_role_name
//         │            - user_status
//         │
//         ▼
// Redirect sesuai role (misal admin → /admin/dashboard)
//         │
//         ▼
// [Route /admin/dashboard] (web.php)
//         │
//         ├─ Middleware auth → cek apakah user login
//         ├─ Middleware isAdministrator → cek session('user_role') == 1
//         │       ├─ Jika true → lanjut ke controller
//         │       └─ Jika false → redirect /
//         ▼
// DashboardAdminController@index
//         │
//         ▼
// Blade dashboard:
// @extends('layouts.lte.main')
//         │
//         ├─ Layout `lte.main` sudah include:
//         │       ├─ Sidebar (menu sesuai role)
//         │       └─ Header
//         │
//         └─ @section('content') → konten dashboard (cards, statistik, dsb)
//         ▼
// Browser tampil:
//     ┌───────────────────────────┐
//     │ Header (username)         │
//     │ Sidebar (menu admin)      │
//     │ Content (dashboard cards) │
//     └───────────────────────────┘
