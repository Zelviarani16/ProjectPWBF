<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;

class AdminController extends Controller
{
    public function index()
    {
        return view('layouts.dashboard-admin');


        // $totalJenisHewan = JenisHewan::count();
        // return view('admin.dashboard', compact('totalJenisHewan'));
    }
}
