@extends('layouts.admin')
@section('title', 'Dashboard Pemilik')

@section('content')

<!-- GREETING SECTION -->
<div class="greeting-banner">
    <div class="greeting-content-left">
        <h1>Halo, {{ Auth::user()->nama }}! 👋</h1>
        <p>Selamat datang kembali di Panel Pemilik</p>
        <p class="greeting-subtitle">Kelola profil, hewan peliharaan, jadwal temu dokter dan rekam medis Anda</p>
    </div>
</div>

<!-- SECTION: Menu Pemilik -->
<div class="section-wrapper">
    <div class="section-header-inline">
        <h2><i class="bi bi-house-fill"></i> Menu Utama Pemilik</h2>
        <span class="section-badge">4 Modules</span>
    </div>

    <div class="cards-grid">

        <!-- Profil -->
        <div class="data-card">
            <div class="card-icon icon-blue"><i class="bi bi-person-badge-fill"></i></div>
            <h4>Profil Saya</h4>
            <p class="card-label">Lihat info akun & alamat</p>
            <a href="{{ route('pemilik.profil') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

        <!-- Daftar Hewan -->
        <div class="data-card">
            <div class="card-icon icon-green"><i class="bi bi-paw-fill"></i></div>
            <h4>Hewan Peliharaan</h4>
            <p class="card-label">Kelola daftar hewan peliharaan</p>
            <a href="{{ route('pemilik.hewan') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

        <!-- Jadwal Temu Dokter -->
        <div class="data-card">
            <div class="card-icon icon-purple"><i class="bi bi-calendar-check-fill"></i></div>
            <h4>Jadwal Temu Dokter</h4>
            <p class="card-label">Lihat jadwal temu dokter untuk hewan</p>
            <a href="{{ route('pemilik.jadwal-temu-dokter') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

        <!-- Rekam Medis -->
        <div class="data-card">
            <div class="card-icon icon-indigo"><i class="bi bi-journal-medical"></i></div>
            <h4>Rekam Medis</h4>
            <p class="card-label">Lihat riwayat rekam medis hewan</p>
            <a href="{{ route('pemilik.rekam-medis') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

    </div>
</div>

@endsection
