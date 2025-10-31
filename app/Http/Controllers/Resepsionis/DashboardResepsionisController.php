<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardResepsionisController extends Controller
{
    public function index()
    {
        return view('resepsionis.dashboard-resepsionis');
    }
}
