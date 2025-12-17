<?php

namespace App\Http\Controllers\Pemilik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function index() 
    {

     $user = Auth::user();
        $pet = $user->pemilik->pets()->with('ras')->get();
        return view('pemilik.pet.index', compact('pet'));
    
    }
}

