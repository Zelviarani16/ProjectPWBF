<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ===== Controllers =====
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;

use App\Http\Controllers\Dokter\PasienPeriksaController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\RoleController; //sdh

use App\Http\Controllers\Dokter\RekamMedisController;
use App\Http\Controllers\Dokter\ProfilDokterController;
use App\Http\Controllers\Admin\DashboardAdminController;

use App\Http\Controllers\Perawat\ProfilPerawatController;

use App\Http\Controllers\Dokter\DashboardDokterController;

use App\Http\Controllers\Pemilik\DashboardPemilikController;
use App\Http\Controllers\Pemilik\PetController as PemilikPetController;
use App\Http\Controllers\Pemilik\ProfilPemilikController;
use App\Http\Controllers\Pemilik\RekamMedisController as PemilikRekamMedisController;
use App\Http\Controllers\Pemilik\TemuDokterController as PemilikTemuDokterController;

use App\Http\Controllers\Admin\KategoriKlinisController; //sdh
use App\Http\Controllers\Perawat\DashboardPerawatController; //--
use App\Http\Controllers\Admin\KodeTindakanTerapiController; //sdh
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Resepsionis\PetController as ResPetController;
use App\Http\Controllers\Admin\PetController as AdminPetController; //sdh
use App\Http\Controllers\Resepsionis\PemilikController as ResPemilikController;
use App\Http\Controllers\Admin\PemilikController as AdminPemilikController; //sdh
use App\Http\Controllers\Resepsionis\TemuDokterController as ResTemuDokterController;


// SITE (PUBLIC AREA SEBELUM LOGIN)
Route::get('/', [SiteController::class, 'home'])->name('landing');
Route::get('layanan', [SiteController::class, 'layanan'])->name('layanan');
Route::get('kontak', [SiteController::class, 'kontak'])->name('kontak');
Route::get('struktur', [SiteController::class, 'struktur'])->name('struktur');

// LOGOUT
// dihapus krn sdh dihandle oleh auth::routes

// Auth routes ini bawaan laravel, dia menyimpan 
//  /login -> get -> menampilkan form login
//  /login -> post -> dia memproses login
//  /logout -> post -> logout
// /register -> get/post -> registrasi kalau tidak di disable
//  dll utk reset password dan verfikasi email kalau aktif.

// Authentication routes (login/register)
Auth::routes();

// sama saja dengan
// GET /login (menampilkan form login -> showLoginController)
// POST /login (memproses login -> loginController@login)
// POST /logout (logout -> loginController@logout)


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

        // Data Pasien
        Route::get('/pasien', [App\Http\Controllers\Dokter\PasienController::class, 'index'])
            ->name('pasien.index');

            


        // =======================
        // REKAM MEDIS UTAMA
        // =======================
        Route::prefix('rekam-medis')->name('rekam-medis.')->group(function () {

            Route::get('/', [RekamMedisController::class, 'index'])
                ->name('index');

            Route::get('/{id}/detail', [RekamMedisController::class, 'showDetail'])
                ->name('showDetail');

            // CRUD detail rekam medis
            Route::get('/{id}/detail/create', [RekamMedisController::class, 'createDetail'])
                ->name('detail.create');

            Route::post('/{id}/detail', [RekamMedisController::class, 'storeDetail'])
                ->name('detail.store');

            Route::get('/detail/{detailId}/edit', [RekamMedisController::class, 'editDetail'])
                ->name('detail.edit');

            Route::put('/detail/{detailId}', [RekamMedisController::class, 'updateDetail'])
                ->name('detail.update');

            Route::delete('/detail/{detailId}', [RekamMedisController::class, 'destroyDetail'])
                ->name('detail.destroy');

            Route::get('/periksa/{idReservasi}', [RekamMedisController::class, 'periksa'])
                ->name('periksa');

        });

        // =======================
        // PASIEN PERIKSA
        // =======================
        Route::get('/pasien/pending', 
            [PasienPeriksaController::class, 'indexPending']
        )->name('pasien.pending');

        Route::get('/pasien/{id}/periksa', [PasienPeriksaController::class, 'periksa'])
            ->name('pasien.periksa'); // atau 'dokter.pasien.periksa' kalau mau tetap name sama

        Route::post('/rekam-medis/{id}/detail/store', [PasienPeriksaController::class, 'storeDetail'])
            ->name('rekam-medis.detail.store');

        Route::post('/pasien/selesai/{id}', 
            [PasienPeriksaController::class, 'selesaiPemeriksaan']
        )->name('pasien.selesai');

        // Profil dokter
        Route::get('/profil', [ProfilDokterController::class, 'index'])->name('profil.index');
        Route::get('/profil/edit', [ProfilDokterController::class, 'edit'])->name('profil.edit');
        Route::post('/profil/update', [ProfilDokterController::class, 'update'])->name('profil.update');
    });


    // PEMILIK AREA
Route::prefix('pemilik')
    ->name('pemilik.')
    ->middleware(['auth', 'isPemilik'])
    ->group(function () {

        // ========================
        // DASHBOARD
        // ========================
        Route::get('/dashboard', 
            [DashboardPemilikController::class, 'index']
        )->name('dashboard');

        // ========================
        // PET / HEWAN
        // ========================
        Route::get('/pet', 
            [App\Http\Controllers\Pemilik\PetController::class, 'index']
        )->name('pet.index');

        // ========================
        // PROFIL PEMILIK
        // ========================
        Route::get('/profil', 
            [App\Http\Controllers\Pemilik\ProfilPemilikController::class, 'index']
        )->name('profil.index');

        Route::get('/profil/edit', 
            [App\Http\Controllers\Pemilik\ProfilPemilikController::class, 'edit']
        )->name('profil.edit');

        Route::post('/profil/update', 
            [App\Http\Controllers\Pemilik\ProfilPemilikController::class, 'update']
        )->name('profil.update');

        // ========================
        // REKAM MEDIS
        // ========================
        Route::get('/rekam-medis', 
            [App\Http\Controllers\Pemilik\RekamMedisController::class, 'rekamMedis']
        )->name('rekam-medis.index');

        Route::get('/rekam-medis/{id}', 
            [App\Http\Controllers\Pemilik\RekamMedisController::class, 'detailRekamMedis']
        )->name('rekam-medis.detail');

        // ========================
        // TEMU DOKTER
        // ========================
        Route::get('/temu-dokter', 
            [App\Http\Controllers\Pemilik\TemuDokterController::class, 'temuDokter']
        )->name('temu-dokter.index');

    });

