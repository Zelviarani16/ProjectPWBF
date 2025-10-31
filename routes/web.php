<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ===== Controllers =====
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanTerapiController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Resepsionis\TemuDokterController;

// ====================== SITE (Public Area) ======================
Route::get('/', [SiteController::class, 'home'])->name('landing');
Route::get('layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('kontak', [SiteController::class, 'kontak'])->name('kontak');
Route::get('struktur', [SiteController::class, 'struktur'])->name('struktur');

// Logout
Route::post('/logout', [LoginController::class, 'Logout'])->name('logout');

// Authentication routes (login/register)
Auth::routes();


// ====================== ADMIN AREA ======================
// Hanya admin & resepsionis yang boleh
// Route::middleware(['auth', 'checkRole:1,4'])->group(function () {
//     Route::get('/pet', [PetController::class, 'index']);
// });



Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'isAdministrator'])
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        Route::resource('jenis-hewan', JenisHewanController::class);
        Route::resource('pemilik', PemilikController::class);
        Route::resource('ras-hewan', RasHewanController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('kategori-klinis', KategoriKlinisController::class);
        Route::resource('kode-tindakan-terapi', KodeTindakanTerapiController::class);
        Route::resource('pet', PetController::class);
        Route::resource('user', UserController::class);
        Route::resource('role', RoleController::class);
    });


// ====================== RESEPSIONIS AREA ======================
Route::prefix('resepsionis')
    ->name('resepsionis.')
    ->middleware(['auth', 'isResepsionis'])
    ->group(function () {
        Route::get('/dashboard', [DashboardResepsionisController::class, 'index'])->name('dashboard');
        
        Route::resource('temu-dokter', TemuDokterController::class);

        Route::resource('pet', App\Http\Controllers\Admin\PetController::class)->only(['index', 'show']);

    });


Route::prefix('pemilik')
    ->name('pemilik.')
    ->middleware(['auth', 'isPemilik'])
    ->group(function () {
        Route::get('/dashboard', [PemilikController::class, 'index'])->name('dashboard');
    });
