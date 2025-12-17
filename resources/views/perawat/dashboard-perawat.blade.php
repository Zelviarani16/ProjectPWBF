@extends('layouts.lte.main')
@section('title', 'Dashboard Perawat')

@section('content')

<!-- Header Info -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h3 class="mb-0">Dashboard Perawat</h3>
                <p class="text-muted">
                    Halo, {{ Auth::user()->nama }} 👋 Selamat datang di Panel Perawat
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Card -->
<div class="app-content">
    <div class="container-fluid">
        <div class="row g-3 justify-content-center">

            <!-- Total Pet -->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-heart-fill fs-1 text-success mb-2"></i>
                        <h5>Data Pet</h5>
                        <h2 class="fw-bold">{{ $totalPet }}</h2>
                        <p class="text-muted">Total Hewan Terdaftar</p>
                        <a href="{{ route('perawat.pasien.index') }}" class="btn btn-sm btn-outline-success mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Rekam Medis -->
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-journal-medical fs-1 text-primary mb-2"></i>
                        <h5>Rekam Medis</h5>
                        <h2 class="fw-bold">{{ $totalRekamMedis }}</h2>
                        <p class="text-muted">Total Riwayat Medis</p>
                        <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-sm btn-outline-primary mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
