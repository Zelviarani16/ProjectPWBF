@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

<!-- Greeting Banner -->
<div class="greeting-banner">
    <div class="greeting-content-left">
        <h1>Halo, {{ Auth::user()->nama }}! 👋</h1>
        <p>Selamat datang kembali di RSHP Panel</p>
        <p class="greeting-subtitle">Mari kelola sistem dengan efisien hari ini!</p>
    </div>
    <!-- <div class="greeting-stats">
        <div class="mini-stat">
            <div class="mini-stat-icon">📊</div>
            <div class="mini-stat-info">
                <h3>{{ $totalAllData ?? 287 }}</h3>
                <p>Total Data</p>
            </div>
        </div>
        <div class="mini-stat">
            <div class="mini-stat-icon">👥</div>
            <div class="mini-stat-info">
                <h3>{{ $totalUsers ?? 24 }}</h3>
                <p>Active Users</p>
            </div>
        </div>
    </div> -->
</div>

<!-- Data Master Section -->
<div class="section-wrapper">
    <div class="section-header-inline">
        <h2><i class="bi bi-database-fill"></i> Data Master</h2>
        <span class="section-badge">9 Modules</span>
    </div>

    <div class="cards-grid">
        <!-- Jenis Hewan -->
        <div class="data-card">
            <div class="card-icon icon-blue"><i class="bi bi-tag-fill"></i></div>
            <h4>Jenis Hewan</h4>
            <p class="card-count">{{ $totalJenisHewan }}</p>
            <p class="card-label">Data Types</p>
            <a href="{{ route('admin.jenis-hewan.index') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

        <!-- Ras Hewan -->
        <div class="data-card">
            <div class="card-icon icon-orange"><i class="bi bi-tags-fill"></i></div>
            <h4>Ras Hewan</h4>
            <p class="card-count">{{ $totalRasHewan }}</p>
            <p class="card-label">Breeds</p>
            <a href="{{ route('admin.ras-hewan.index') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

        <!-- Kategori -->
        <div class="data-card">
            <div class="card-icon icon-pink"><i class="bi bi-folder-fill"></i></div>
            <h4>Kategori</h4>
            <p class="card-count">{{ $totalKategori }}</p>
            <p class="card-label">Categories</p>
            <a href="{{ route('admin.kategori.index') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

        <!-- Kategori Klinis -->
        <div class="data-card">
            <div class="card-icon icon-teal"><i class="bi bi-clipboard-pulse"></i></div>
            <h4>Kategori Klinis</h4>
            <p class="card-count">{{ $totalKategoriKlinis }}</p>
            <p class="card-label">Clinical Types</p>
            <a href="{{ route('admin.kategori-klinis.index') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

        <!-- Kode Tindakan Terapi -->
        <div class="data-card">
            <div class="card-icon icon-purple"><i class="bi bi-file-medical-fill"></i></div>
            <h4>Kode Tindakan</h4>
            <p class="card-count">{{ $totalKodeTindakan }}</p>
            <p class="card-label">Action Codes</p>
            <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

        <!-- Pet -->
        <div class="data-card">
            <div class="card-icon icon-red"><i class="bi bi-heart-fill"></i></div>
            <h4>Pet</h4>
            <p class="card-count">{{ $totalPet }}</p>
            <p class="card-label">Registered Pets</p>
            <a href="{{ route('admin.pet.index') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

        <!-- User -->
        <div class="data-card">
            <div class="card-icon icon-indigo"><i class="bi bi-people-fill"></i></div>
            <h4>User</h4>
            <p class="card-count">{{ $totalUsers }}</p>
            <p class="card-label">System Users</p>
            <a href="{{ route('admin.user.index') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

        <!-- Role -->
        <div class="data-card">
            <div class="card-icon icon-green"><i class="bi bi-shield-fill-check"></i></div>
            <h4>Role</h4>
            <p class="card-count">{{ $totalRoles }}</p>
            <p class="card-label">User Roles</p>
            <a href="{{ route('admin.role.index') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>

        <!-- Pemilik -->
        <div class="data-card">
            <div class="card-icon icon-yellow"><i class="bi bi-person-badge-fill"></i></div>
            <h4>Pemilik</h4>
            <p class="card-count">{{ $totalPemilik  }}</p>
            <p class="card-label">Pet Owners</p>
            <a href="{{ route('admin.pemilik.index') }}" class="card-link">
                <i class="bi bi-arrow-right-circle-fill"></i>
            </a>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<!-- <div class="section-wrapper">
    <div class="section-header-inline">
        <h2><i class="bi bi-clock-history"></i> Aktivitas Terbaru</h2>
        <a href="#" class="btn-view-all">Lihat Semua</a>
    </div>

    <div class="activity-container">
        <div class="activity-item">
            <div class="activity-icon activity-icon-success">
                <i class="bi bi-plus-circle-fill"></i>
            </div>
            <div class="activity-content">
                <p class="activity-title">Data baru ditambahkan</p>
                <p class="activity-desc">Pet "Max" berhasil didaftarkan ke sistem</p>
                <p class="activity-time">5 menit yang lalu</p>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon activity-icon-warning">
                <i class="bi bi-pencil-fill"></i>
            </div>
            <div class="activity-content">
                <p class="activity-title">Data diperbarui</p>
                <p class="activity-desc">Role "Dokter" telah dimodifikasi</p>
                <p class="activity-time">15 menit yang lalu</p>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon activity-icon-info">
                <i class="bi bi-person-fill-add"></i>
            </div>
            <div class="activity-content">
                <p class="activity-title">User baru terdaftar</p>
                <p class="activity-desc">Dr. Sarah bergabung sebagai Dokter</p>
                <p class="activity-time">1 jam yang lalu</p>
            </div>
        </div>

        <div class="activity-item">
            <div class="activity-icon activity-icon-danger">
                <i class="bi bi-trash-fill"></i>
            </div>
            <div class="activity-content">
                <p class="activity-title">Data dihapus</p>
                <p class="activity-desc">Kategori "Lain-lain" dihapus dari sistem</p>
                <p class="activity-time">2 jam yang lalu</p>
            </div>
        </div>
    </div>
</div> -->

@endsection

@push('styles')
<style>
    /* ===== GREETING BANNER ===== */
    .greeting-banner {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 35px 40px;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.35);
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

    .greeting-banner p {
        font-size: 15px;
        margin: 0;
        opacity: 0.95;
    }

    .greeting-subtitle {
        font-size: 14px !important;
        opacity: 0.85 !important;
        margin-top: 4px !important;
    }

    .greeting-stats {
        display: flex;
        gap: 20px;
    }

    .mini-stat {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 14px;
        padding: 16px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 140px;
    }

    .mini-stat-icon {
        font-size: 32px;
    }

    .mini-stat-info h3 {
        font-size: 24px;
        font-weight: 700;
        margin: 0;
    }

    .mini-stat-info p {
        font-size: 12px;
        margin: 0;
        opacity: 0.9;
    }

    /* ===== SECTION ===== */
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
        color: #667eea;
    }

    .section-badge {
        background: #eff6ff;
        color: #3b82f6;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-view-all {
        padding: 8px 18px;
        border: 1.5px solid #667eea;
        border-radius: 10px;
        color: #667eea;
        text-decoration: none;
        transition: 0.3s;
        font-weight: 600;
        font-size: 14px;
    }

    .btn-view-all:hover {
        background: #667eea;
        color: #fff;
        transform: translateY(-2px);
    }

    /* ===== DATA CARDS GRID ===== */
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
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .data-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
        transform: scaleX(0);
        transition: 0.3s;
    }

    .data-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(102, 126, 234, 0.2);
    }

    .data-card:hover::before {
        transform: scaleX(1);
    }

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

    .icon-blue { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .icon-orange { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .icon-pink { background: linear-gradient(135deg, #ec4899, #db2777); }
    .icon-teal { background: linear-gradient(135deg, #14b8a6, #0d9488); }
    .icon-purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
    .icon-red { background: linear-gradient(135deg, #ef4444, #dc2626); }
    .icon-indigo { background: linear-gradient(135deg, #6366f1, #4f46e5); }
    .icon-green { background: linear-gradient(135deg, #10b981, #059669); }
    .icon-yellow { background: linear-gradient(135deg, #f59e0b, #ea580c); }

    .data-card h4 {
        font-size: 15px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .card-count {
        font-size: 28px;
        font-weight: 800;
        color: #667eea;
        margin: 8px 0 4px;
    }

    .card-label {
        color: #6b7280;
        font-size: 12px;
        margin: 0;
    }

    .data-card .card-link {
        position: absolute;
        bottom: 12px;
        right: 12px;
        color: #667eea;
        font-size: 20px;
        opacity: 0;
        transition: 0.3s;
    }

    .data-card:hover .card-link {
        opacity: 1;
        transform: translateX(-4px);
    }


    /* ===== ACTIVITY ===== */
    .activity-container {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
    }

    .activity-item {
        display: flex;
        gap: 16px;
        padding: 16px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        flex-shrink: 0;
    }

    .activity-icon-success { background: #10b981; }
    .activity-icon-warning { background: #f59e0b; }
    .activity-icon-info { background: #3b82f6; }
    .activity-icon-danger { background: #ef4444; }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-weight: 600;
        color: #1f2937;
        font-size: 14px;
        margin: 0 0 4px;
    }

    .activity-desc {
        font-size: 13px;
        color: #6b7280;
        margin: 0 0 6px;
    }

    .activity-time {
        font-size: 12px;
        color: #9ca3af;
        margin: 0;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .greeting-banner {
            padding: 28px 24px;
        }

        .greeting-banner h1 {
            font-size: 26px;
        }

        .greeting-stats {
            width: 100%;
            justify-content: space-between;
        }

        .mini-stat {
            min-width: auto;
            flex: 1;
        }

        .cards-grid {
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 16px;
        }

        .quick-access-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush