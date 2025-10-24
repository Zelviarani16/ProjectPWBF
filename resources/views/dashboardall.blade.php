@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Welcome Section -->
<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="me-3">
                <i class="bi bi-house-door" style="font-size: 2.5rem; color: #3498db;"></i>
            </div>
            <div>
                <h2 class="mb-1" style="font-size: 24px; font-weight: 700; color: #2c3e50;">Dashboard</h2>
                <p class="mb-0" style="color: #7f8c8d;">Selamat datang di halaman {{ Auth::user()->role ?? 'User' }}!</p>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="stats-card blue">
            <div class="stats-label">Total Jenis Hewan</div>
            <h2 class="stats-value">{{ $totalJenisHewan ?? 5 }}</h2>
            <i class="bi bi-bookmark stats-icon"></i>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="stats-card green">
            <div class="stats-label">Total Ras Hewan</div>
            <h2 class="stats-value">{{ $totalRasHewan ?? 12 }}</h2>
            <i class="bi bi-heart-pulse stats-icon"></i>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="stats-card cyan">
            <div class="stats-label">Total Data Hewan</div>
            <h2 class="stats-value">{{ $totalHewan ?? 45 }}</h2>
            <i class="bi bi-clipboard-pulse stats-icon"></i>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-3">
        <div class="stats-card purple">
            <div class="stats-label">Total User</div>
            <h2 class="stats-value">{{ $totalUser ?? 8 }}</h2>
            <i class="bi bi-people stats-icon"></i>
        </div>
    </div>
</div>

<!-- Main Content Row -->
<div class="row">
    <!-- Quick Actions -->
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h3><i class="bi bi-lightning-charge"></i> Aksi Cepat</h3>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('jenis-hewan.create') }}" class="btn btn-outline-primary text-start">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Jenis Hewan
                    </a>
                    <a href="#" class="btn btn-outline-success text-start">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Ras Hewan
                    </a>
                    <a href="#" class="btn btn-outline-info text-start">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Data Hewan
                    </a>
                    <a href="#" class="btn btn-outline-warning text-start">
                        <i class="bi bi-file-earmark-text me-2"></i>Lihat Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header">
                <h3><i class="bi bi-clock-history"></i> Aktivitas Terbaru</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Aktivitas</th>
                                <th>Pengguna</th>
                                <th>Waktu</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <i class="bi bi-plus-circle text-success me-2"></i>
                                    Menambah data jenis hewan "Mamalia"
                                </td>
                                <td>Admin</td>
                                <td>2 jam lalu</td>
                                <td><span class="badge bg-success">Success</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="bi bi-pencil text-warning me-2"></i>
                                    Mengupdate ras hewan "Persian Cat"
                                </td>
                                <td>User 1</td>
                                <td>5 jam lalu</td>
                                <td><span class="badge bg-warning">Updated</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="bi bi-trash text-danger me-2"></i>
                                    Menghapus data hewan "Rex-001"
                                </td>
                                <td>Admin</td>
                                <td>1 hari lalu</td>
                                <td><span class="badge bg-danger">Deleted</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="bi bi-plus-circle text-success me-2"></i>
                                    Menambah ras hewan "Labrador"
                                </td>
                                <td>User 2</td>
                                <td>2 hari lalu</td>
                                <td><span class="badge bg-success">Success</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="bi bi-eye text-info me-2"></i>
                                    Melihat detail hewan "Fluffy"
                                </td>
                                <td>User 3</td>
                                <td>3 hari lalu</td>
                                <td><span class="badge bg-info">Viewed</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Info Box -->
<div class="row">
    <div class="col-lg-12">
        <div class="info-box blue">
            <div class="d-flex align-items-start">
                <div class="me-3">
                    <i class="bi bi-info-circle" style="font-size: 2rem; color: #3498db;"></i>
                </div>
                <div>
                    <h5>Tips Penggunaan Sistem</h5>
                    <ul>
                        <li>Pastikan data yang diinput sudah benar sebelum menyimpan</li>
                        <li>Gunakan fitur pencarian untuk menemukan data dengan cepat</li>
                        <li>Backup data secara berkala untuk keamanan</li>
                        <li>Hubungi administrator jika mengalami kendala teknis</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection