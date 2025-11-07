<?php

namespace App\Http\Controllers\Resepsionis;

use App\Models\Pet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PetController extends Controller
{
      public function index()
    {
        // Ambil semua data daro tabel kategori_klinis lewat model
        $pet = Pet::with(['pemilik.user', 'rasHewan'])->get();
        // Kirim data ke view blade
        return view('admin.pet.index', compact('pet'));
    }

}