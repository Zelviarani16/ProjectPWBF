<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function layanan() {
        return view('layanan');
    }

    public function kontak() {
        return view('kontak');
    }

    public function struktur() {
        return view('struktur');
    }


}
