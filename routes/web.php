<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Site\SiteController;

// bisa juga dijalankan utk hanya menaampilkan function teks saja
Route::get('/', function () {
    return view('welcome');
});

// ini sdh di set home, jadi ketika akses /home akan diarahkan ke view lalu home, jadi tidak akan 404 not found
Route::get('home', [SiteController::class, 'home'])->name('home');
Route::get('layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('kontak', [SiteController::class, 'kontak'])->name('kontak');
Route::get('struktur', [SiteController::class, 'struktur'])->name('struktur');
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'processLogin'])->name('login.process');

// Logout
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard admin
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

use App\Http\Controllers\Admin\AdminController;

Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin.dashboard');




// Route::get('/home', [SiteController::class, 'home']);
// Route::get('/struktur', [SiteController::class, 'struktur']);
// Route::get('/layanan', [SiteController::class, 'layanan']);
// Route::get('/kontak', [SiteController::class, 'kontak']);
// Route::get('/login', [SiteController::class, 'login']);

