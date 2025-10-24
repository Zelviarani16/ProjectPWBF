<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('tampilan.login');
    }

    public function processLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        // Ambil user berdasarkan email
        $user = DB::table('user')->where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {

            // Ambil role user dari tabel role_user
            $roleUser = DB::table('role_user')
                ->join('role', 'role.idrole', '=', 'role_user.idrole')
                ->where('role_user.iduser', $user->iduser)
                ->where('role_user.status', 1)
                ->select('role.idrole', 'role.nama_role')
                ->first();

            // Simpan session
            Session::put('user_id', $user->iduser);
            Session::put('user_email', $user->email);
            Session::put('user_role', $roleUser ? $roleUser->nama_role : null);

            // Cek role dan redirect
            if ($roleUser) {
                switch ($roleUser->idrole) {
                    case 1:
                        return redirect('/admin/dashboard');
                    case 2:
                        return redirect('/dokter/dashboard');
                    case 3:
                        return redirect('/perawat/dashboard');
                    case 4:
                        return redirect('/resepsionis/dashboard');
                    case 5:
                        return redirect('/pemilik/dashboard');
                }
            }

            return redirect('/login')->withErrors(['role' => 'Role Anda belum aktif!']);
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
