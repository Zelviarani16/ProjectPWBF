<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ===== Controllers =====
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin\RoleController; //sdh
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\KategoriKlinisController; //sdh

use App\Http\Controllers\Perawat\DashboardPerawatController; //--
use App\Http\Controllers\Admin\KodeTindakanTerapiController; //sdh
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;

use App\Http\Controllers\Resepsionis\PetController as ResPetController;
use App\Http\Controllers\Admin\PetController as AdminPetController; //sdh
use App\Http\Controllers\Resepsionis\PemilikController as ResPemilikController;
use App\Http\Controllers\Admin\PemilikController as AdminPemilikController; //sdh
use App\Http\Controllers\Resepsionis\TemuDokterController as ResTemuDokterController;

// SITE (PUBLIC AREA)
Route::get('/', [SiteController::class, 'home'])->name('landing');
Route::get('layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('kontak', [SiteController::class, 'kontak'])->name('kontak');
Route::get('struktur', [SiteController::class, 'struktur'])->name('struktur');

// LOGOUT
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Auth routes ini bawaan laravel, dia menyimpan 
//  /login -> get -> menampilkan form login
//  /login -> post -> dia memproses login
//  /logout -> post -> logout
// /register -> get/post -> registrasi kalau tidak di disable
//  dll utk reset password dan verfiikasi email kalau aktif.

// Authentication routes (login/register)
Auth::routes();


// ADMIN AREA
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'isAdministrator' ])
    ->group(function () {
        Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard');

        Route::resource('jenis-hewan', App\Http\Controllers\Admin\JenisHewanController::class);
        Route::resource('pemilik', AdminPemilikController::class);
        Route::resource('ras-hewan', App\Http\Controllers\Admin\RasHewanController::class);
        Route::resource('kategori', App\Http\Controllers\Admin\KategoriController::class);
        Route::resource('kategori-klinis', App\Http\Controllers\Admin\KategoriKlinisController::class);
        Route::resource('kode-tindakan-terapi', App\Http\Controllers\Admin\KodeTindakanTerapiController::class);
        Route::resource('pet', AdminPetController::class);
        Route::resource('user', App\Http\Controllers\Admin\UserController::class);
        Route::resource('role', App\Http\Controllers\Admin\RoleController::class);
    });

// RESEPSIONIS AREA
Route::prefix('resepsionis')
    ->name('resepsionis.')
    ->middleware(['auth', 'isResepsionis'])
    ->group(function () {
        Route::get('/dashboard', [DashboardResepsionisController::class, 'index'])->name('dashboard');
        
        Route::resource('temu-dokter', ResTemuDokterController::class);
        Route::resource('pet', ResPetController::class)->only(['index', 'show']);
        Route::resource('role', RoleController::class)->only(['index', 'show']);
        Route::resource('pemilik', ResPemilikController::class)->only(['index', 'show']);
    });

Route::prefix('perawat')
    ->name('perawat.')
    ->middleware(['auth', 'isPerawat'])
    ->group(function () {
        Route::get('/dashboard', [DashboardPerawatController::class, 'index'])->name('dashboard');
    });


