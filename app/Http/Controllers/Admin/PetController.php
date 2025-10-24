<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;

class PetController extends Controller
{
    public function index()
    {
        $pet = Pet::with(['pemilik.user', 'rasHewan'])->get();
        return view('admin.pet.index', compact('pet'));
    }
}
