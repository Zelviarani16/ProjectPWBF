@extends('layouts.lte.main')

@section('title', 'Dashboard Resepsionis')

@section('content')

<!-- Header Info -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h3 class="mb-0">Dashboard Resepsionis</h3>
                <p class="text-muted">
                    Halo, {{ Auth::user()->nama }} 👋 Selamat datang di Panel Resepsionis
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Card -->
<div class="app-content">
    <div class="container-fluid">

        <div class="row g-3">

            <!-- Total Pemilik -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-person-fill fs-1 text-primary mb-2"></i>
                        <h5>Data Pemilik</h5>
                        <h2 class="fw-bold">{{ $totalPemilik }}</h2>
                        <p class="text-muted">Total Pemilik Terdaftar</p>
                        <a href="{{ route('admin.pemilik.index') }}" class="btn btn-sm btn-outline-primary mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Pet -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-heart-fill fs-1 text-success mb-2"></i>
                        <h5>Data Pet</h5>
                        <h2 class="fw-bold">{{ $totalPet }}</h2>
                        <p class="text-muted">Total Hewan Terdaftar</p>
                        <a href="{{ route('admin.pet.index') }}" class="btn btn-sm btn-outline-success mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Temu Dokter -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-heart-fill fs-1 text-warning mb-2"></i>
                        <h5>Temu Dokter</h5>
                        <h2 class="fw-bold">{{ $totalTemuDokter }}</h2>
                        <p class="text-muted">Total Jadwal</p>
                        <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-sm btn-outline-warning mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
