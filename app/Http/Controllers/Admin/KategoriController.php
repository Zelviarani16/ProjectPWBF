<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel jenis_hewan lewat model
        $kategori = Kategori::all();
        // Kirim data ke view blade
        return view('admin.kategori.index', compact('kategori'));
    }
}
?>