<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\KategoriKlinis;
use App\Models\KodeTindakanTerapi;
use App\Http\Controllers\Controller;

class KodeTindakanTerapiController extends Controller
{
    public function index()
    {
        $kodeTindakanTerapi = KodeTindakanTerapi::with(['kategori', 'kategoriKlinis'])->get();
        return view('admin.kode-tindakan-terapi.index', compact('kodeTindakanTerapi'));
    }
}
