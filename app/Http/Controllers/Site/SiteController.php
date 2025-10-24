<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function cekKoneksi()
    {
        try {
            DB::connection()->getPdo();
            return 'Koneksi ke database berhasil!';
        } catch (\Exception $e) {
            return 'Koneksi ke database gagal: ' . $e->getMessage();
        }

    }

    public function home()
    {
        return view('tampilan.home');
    }

    public function layanan() {
        return view('tampilan.layanan');
    }

    public function kontak() {
        return view('tampilan.kontak');
    }

    public function struktur() {
        return view('tampilan.struktur');
    }

    public function login() {
        return view('tampilan.login');
    }


}
