<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        // Ambil semua data daro tabel kategori_klinis lewat model
        $kategoriKlinis = KategoriKlinis::all();
        $lastKategori = $kategoriKlinis->last();
        // Kirim data ke view blade
        return view('admin.kategori-klinis.index', compact('kategoriKlinis', 'lastKategori'));
    }
}