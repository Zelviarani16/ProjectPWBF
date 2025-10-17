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
        return view('login'); // halaman login
    }

    public function processLogin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = DB::table('user')->where('email', $email)->first();
    }
}
