@extends('layouts.lte.main')

@section('title', 'Dashboard Pemilik')

@section('content')

<!-- Header Info -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-6">
                <h3 class="mb-0">Dashboard Pemilik</h3>
                <p class="text-muted">
                    Halo, {{ Auth::user()->nama }} 👋 Selamat datang di Panel Pemilik
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Card -->
<div class="app-content">
    <div class="container-fluid">

        <div class="row g-3">

            <!-- Total Hewan Peliharaan -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-heart-fill fs-1 text-danger mb-2"></i>
                        <h5>Hewan Peliharaan</h5>
                        <h2 class="fw-bold">{{ $totalPet }}</h2>
                        <p class="text-muted">Total Pet Terdaftar</p>
                        <a href="{{ route('pemilik.pet.index') }}" class="btn btn-sm btn-outline-success mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Jadwal Temu Dokter -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-check-fill fs-1 text-warning mb-2"></i>
                        <h5>Temu Dokter</h5>
                        <h2 class="fw-bold">{{ $totalTemuDokter }}</h2>
                        <p class="text-muted">Total Jadwal</p>
                        <a href="{{ route('pemilik.temu-dokter.index') }}" class="btn btn-sm btn-outline-warning mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

            <!-- Total Rekam Medis -->
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-journal-medical fs-1 text-danger mb-2"></i>
                        <h5>Rekam Medis</h5>
                        <h2 class="fw-bold">{{ $totalRekamMedis }}</h2>
                        <p class="text-muted">Total Riwayat Medis</p>
                        <a href="{{ route('pemilik.rekam-medis.index') }}" class="btn btn-sm btn-outline-danger mt-2">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>

        </div>



    </div>
</div>

@endsection
