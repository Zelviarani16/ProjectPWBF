@extends('layouts.admin')
@section('title', 'Dashboard Perawat')

@section('content')

<!-- GREETING SECTION -->
<div class="greeting-banner">
    <div class="greeting-content-left">
        <h1>Halo, {{ Auth::user()->nama }}! 👋</h1>
        <p>Selamat datang kembali di RSHP Panel</p>
        <p class="greeting-subtitle">Kelola rekam medis dan data pasien dengan mudah!</p>
    </div>
</div>

<!-- SECTION: Tugas Perawat -->
<div class="section-wrapper">
    <div class="section-header-inline">
        <h2><i class="bi bi-clipboard2-pulse-fill"></i> Menu Utama Perawat</h2>
        <span class="section-badge">4 Modules</span>
    </div>

    <div class="cards-grid">

        <!-- View Data Pasien -->
        <div class="data-card">
            <div class="card-icon icon-blue"><i class="bi bi-people-fill"></i></div>
            <h4>Data Pasien</h4>
            <p class="card-label">Lihat seluruh data pasien</p>
            <a href="{{ route('perawat.pasien.index') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

        <!-- CRUD Rekam Medis -->
        <div class="data-card">
            <div class="card-icon icon-green"><i class="bi bi-journal-medical"></i></div>
            <h4>Rekam Medis</h4>
            <p class="card-label">Tambah & kelola rekam medis</p>
            <a href="{{ route('perawat.rekam-medis.index') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

        <!-- Detail Rekam Medis -->
        <div class="data-card">
            <div class="card-icon icon-purple"><i class="bi bi-file-medical-fill"></i></div>
            <h4>Detail Rekam Medis</h4>
            <p class="card-label">Lihat detail tindakan klinis</p>
            <a href="{{ route('perawat.rekam-medis.index') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

        <!-- Profil Perawat -->
        <div class="data-card">
            <div class="card-icon icon-indigo"><i class="bi bi-person-badge-fill"></i></div>
            <h4>Profil Saya</h4>
            <p class="card-label">Informasi akun & identitas perawat</p>
            <a href="{{ route('perawat.profil.index') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

    </div>
</div>

@endsection


@push('styles')
<style>
    /* ========== REUSE STYLE FROM ADMIN (already matching) ========== */

    .greeting-banner {
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        border-radius: 20px;
        padding: 35px 40px;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 8px 24px rgba(34, 197, 94, 0.3);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .greeting-banner h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .greeting-subtitle {
        font-size: 14px !important;
        opacity: 0.85 !important;
        margin-top: 4px !important;
    }

    .section-wrapper {
        margin-bottom: 40px;
    }

    .section-header-inline {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .section-header-inline h2 {
        font-size: 20px;
        font-weight: 700;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-header-inline h2 i {
        color: #16a34a;
    }

    .section-badge {
        background: #dcfce7;
        color: #16a34a;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 20px;
    }

    .data-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        transition: 0.3s;
        position: relative;
        overflow: hidden;
    }

    .data-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(34, 197, 94, 0.2);
    }

    .data-card .card-link {
        position: absolute;
        bottom: 12px;
        right: 12px;
        color: #16a34a;
        font-size: 20px;
        opacity: 0;
        transition: 0.3s;
    }

    .data-card:hover .card-link {
        opacity: 1;
        transform: translateX(-4px);
    }

    /* ICON COLORS */
    .icon-blue { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .icon-green { background: linear-gradient(135deg, #22c55e, #16a34a); }
    .icon-purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
    .icon-indigo { background: linear-gradient(135deg, #6366f1, #4f46e5); }

    .card-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin: 0 auto 12px;
        font-size: 24px;
    }

    .data-card h4 {
        font-size: 16px;
        font-weight: 700;
        color: #1f2937;
    }

    .data-card p {
        font-size: 13px;
        color: #6b7280;
    }

</style>
@endpush
