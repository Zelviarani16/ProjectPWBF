<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanTerapiController;

// ========== SITE (Public Area) ==========
// get('home') dia akan mendeteksi ketika kita mengetikkan ini di web, diarahkan ke site controller dan cari method home, kalau name digunakan utk 
Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('home', [SiteController::class, 'home'])->name('home');
Route::get('layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('kontak', [SiteController::class, 'kontak'])->name('kontak');
Route::get('struktur', [SiteController::class, 'struktur'])->name('struktur');

// ========== AUTH ==========
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'processLogin'])->name('login.process');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// ========== ADMIN AREA ==========
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    // ini tdk ikut prefix karena pakai /
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // CRUD Jenis Hewan
    Route::resource('jenis-hewan', JenisHewanController::class);

    // Ras Hewan
    Route::resource('ras-hewan', RasHewanController::class);

    // Kategorii
    Route::resource('kategori', KategoriController::class);

    // Kategori Klinis
    Route::resource('kategori-klinis', KategoriKlinisController::class);

    // Kode tindakan terapi
    Route::resource('kode-tindakan-terapi', KodeTindakanTerapiController::class);

    
    // Pet
    Route::resource('pet', PetController::class);

    // User
    Route::resource('user', UserController::class);

    // Role
    Route::resource('role', RoleController::class);


});
