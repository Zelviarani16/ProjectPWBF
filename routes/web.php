<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ===== Controllers =====
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\RoleController; //sdh
use App\Http\Controllers\Dokter\RekamMedisController;

use App\Http\Controllers\Dokter\ProfilDokterController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Perawat\ProfilPerawatController;

use App\Http\Controllers\Dokter\DashboardDokterController;

use App\Http\Controllers\Pemilik\DashboardPemilikController;
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

        // Route manajemen role user
        Route::get('user-role', [UserRoleController::class, 'index'])
            ->name('user-role.index');
        Route::get('user-role/create', [UserRoleController::class, 'create'])
            ->name('user-role.create');
        Route::post('user-role', [\App\Http\Controllers\Admin\UserRoleController::class, 'store'])
            ->name('user-role.store');
        Route::delete('user-role/{iduser}/{idrole}', [\App\Http\Controllers\Admin\UserRoleController::class, 'destroy'])
            ->name('user-role.destroy');

        Route::get('user-role/{iduser}/{idrole}/edit', [UserRoleController::class, 'edit'])
            ->name('user-role.edit');
        Route::put('user-role/{iduser}/{idrole}', [UserRoleController::class, 'update'])
            ->name('user-role.update');




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
        Route::post('temu-dokter/{id}/selesai', [ResTemuDokterController::class, 'selesai'])
            ->name('temu-dokter.selesai');
        Route::resource('pet', ResPetController::class);
        Route::resource('role', RoleController::class);
        Route::resource('pemilik', ResPemilikController::class);
    });

// PERAWAT AREA
Route::prefix('perawat')
    ->name('perawat.')
    ->middleware(['auth', 'isPerawat'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardPerawatController::class, 'index'])
            ->name('dashboard');

        // Data Pasien (view only)
        Route::get('/pasien', 
            [App\Http\Controllers\Perawat\PasienController::class, 'index'])
            ->name('pasien.index');

        // Rekam Medis (CRUD)
        Route::resource('rekam-medis', 
            App\Http\Controllers\Perawat\RekamMedisController::class);

        // Detail Rekam Medis (view only)
        Route::get('/rekam-medis/{id}/detail', 
            [App\Http\Controllers\Perawat\RekamMedisController::class, 'showDetail'])
            ->name('rekam-medis.detail');


        // Route profil perawat - READ ONLY
        Route::get('/profil', [ProfilPerawatController::class, 'index'])
            ->name('profil.index');
        
        // Route edit profil - FORM EDIT
        Route::get('/profil/edit', [ProfilPerawatController::class, 'edit'])
            ->name('profil.edit');
        
        // Route update profil - PROSES UPDATE
        Route::post('/profil/update', [ProfilPerawatController::class, 'update'])
            ->name('profil.update');
            
    }); 


    // DOKTER AREA
Route::prefix('dokter')
    ->name('dokter.')
    ->middleware(['auth', 'isDokter'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardDokterController::class, 'index'])
            ->name('dashboard');

        // Data pasien
        Route::get('/pasien', [App\Http\Controllers\Dokter\PasienController::class, 'index'])
            ->name('pasien.index');

        // ===================
        // Rekam Medis Utama
        // ===================
        Route::prefix('rekam-medis')->group(function () {

        Route::get('/', [RekamMedisController::class, 'index'])
            ->name('rekam-medis.index');

        Route::get('/{id}/detail', [RekamMedisController::class, 'showDetail'])
            ->name('rekam-medis.showDetail');

    // =============================
    // CRUD Detail Rekam Medis
    // =============================

    Route::get('/{id}/detail/create', [RekamMedisController::class, 'createDetail'])
        ->name('rekam-medis.detail.create');

    Route::post('/{id}/detail', [RekamMedisController::class, 'storeDetail'])
        ->name('rekam-medis.detail.store');

    Route::get('/detail/{detailId}/edit', [RekamMedisController::class, 'editDetail'])
        ->name('rekam-medis.detail.edit');

    Route::put('/detail/{detailId}', [RekamMedisController::class, 'updateDetail'])
        ->name('rekam-medis.detail.update');

    Route::delete('/detail/{detailId}', [RekamMedisController::class, 'destroyDetail'])
        ->name('rekam-medis.detail.destroy');

        // Profil dokter
        Route::get('/profil', [ProfilDokterController::class, 'index'])->name('profil.index');
        Route::get('/profil/edit', [ProfilDokterController::class, 'edit'])->name('profil.edit');
        Route::post('/profil/update', [ProfilDokterController::class, 'update'])->name('profil.update');
    });

});

// PEMILIK AREA
Route::prefix('pemilik')
    ->name('pemilik.')
    ->middleware(['auth', 'isPemilik'])
    ->group(function() {
        Route::get('/dashboard', [DashboardPemilikController::class, 'index'])->name('dashboard');
        Route::get('/profil', [DashboardPemilikController::class, 'profil'])->name('profil');
        Route::get('/hewan', [DashboardPemilikController::class, 'hewan'])->name('hewan');
        Route::get('/jadwal-temu-dokter', [DashboardPemilikController::class, 'jadwalTemuDokter'])->name('jadwal-temu-dokter');
        Route::get('/rekam-medis', [DashboardPemilikController::class, 'rekamMedis'])->name('rekam-medis');
        Route::get('/rekam-medis/{id}', [DashboardPemilikController::class, 'detailRekamMedis'])->name('detail-rekam-medis');
});

