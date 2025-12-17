@extends('layouts.lte.main')
<!-- knp ga include sidebar? krn semua navbar sidebar footer sdh dihandle oleh lte.main -->

@section('title', 'Dashboard Admin')

@section('content')

<!-- Header Info -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h3 class="mb-0">Dashboard Admin</h3>
                <p class="text-muted">Halo, {{ Auth::user()->nama }} 👋 Selamat datang di RSHP Panel</p>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Card -->
<div class="app-content">
    <div class="container-fluid">

        <div class="row g-3">

            <!-- Jenis Hewan -->
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-tag-fill fs-1 text-primary mb-2"></i>
                        <h5>Jenis Hewan</h5>
                        <h2 class="fw-bold">{{ $totalJenisHewan }}</h2>
                        <p class="text-muted">Data Types</p>
                        <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-sm btn-outline-primary mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            <!-- Ras Hewan -->
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-tags-fill fs-1 text-warning mb-2"></i>
                        <h5>Ras Hewan</h5>
                        <h2 class="fw-bold">{{ $totalRasHewan }}</h2>
                        <p class="text-muted">Breeds</p>
                        <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-sm btn-outline-warning mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kategori -->
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-folder-fill fs-1 text-pink mb-2"></i>
                        <h5>Kategori</h5>
                        <h2 class="fw-bold">{{ $totalKategori }}</h2>
                        <p class="text-muted">Categories</p>
                        <a href="{{ route('admin.kategori.index') }}" class="btn btn-sm btn-outline-info mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            <!-- Kategori Klinis -->
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-clipboard2-pulse-fill fs-1 text-teal mb-2"></i>
                        <h5>Kategori Klinis</h5>
                        <h2 class="fw-bold">{{ $totalKategoriKlinis }}</h2>
                        <p class="text-muted">Clinical Types</p>
                        <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-sm btn-outline-success mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <div class="row g-3 mt-1">

            <!-- Kode Tindakan -->
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-file-medical-fill fs-1 text-purple mb-2"></i>
                        <h5>Kode Tindakan</h5>
                        <h2 class="fw-bold">{{ $totalKodeTindakan }}</h2>
                        <p class="text-muted">Action Codes</p>
                        <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-sm btn-outline-primary mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pet -->
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-heart-fill fs-1 text-danger mb-2"></i>
                        <h5>Pet</h5>
                        <h2 class="fw-bold">{{ $totalPet }}</h2>
                        <p class="text-muted">Registered Pets</p>
                        <a href="{{ route('admin.pet.index') }}" class="btn btn-sm btn-outline-danger mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            <!-- User -->
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-people-fill fs-1 text-indigo mb-2"></i>
                        <h5>User</h5>
                        <h2 class="fw-bold">{{ $totalUsers }}</h2>
                        <p class="text-muted">System Users</p>
                        <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-outline-dark mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            <!-- Role -->
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-shield-fill-check fs-1 text-success mb-2"></i>
                        <h5>Role</h5>
                        <h2 class="fw-bold">{{ $totalRoles }}</h2>
                        <p class="text-muted">User Roles</p>
                        <a href="{{ route('admin.role.index') }}" class="btn btn-sm btn-outline-success mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            <!-- Pemilik -->
            <div class="col-md-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-person-badge-fill fs-1 text-warning mb-2"></i>
                        <h5>Pemilik</h5>
                        <h2 class="fw-bold">{{ $totalPemilik }}</h2>
                        <p class="text-muted">Pet Owners</p>
                        <a href="{{ route('admin.pemilik.index') }}" class="btn btn-sm btn-outline-warning mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
