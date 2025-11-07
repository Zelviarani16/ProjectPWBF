@extends('layouts.admin')

@section('content')

<!-- Greeting Banner -->
<div class="greeting-banner">
    <div class="greeting-content-left">
        <h1>
            @php
                $hour = date('H');
                if ($hour < 12) {
                    echo 'Good Morning';
                } elseif ($hour < 18) {
                    echo 'Good Afternoon';
                } else {
                    echo 'Good Evening';
                }
            @endphp
            {{ Auth::user()->name }} 👋
        </h1>
        <p>Selamat mengelola data sistem RSHP Universitas Airlangga</p>
        <p class="greeting-subtitle">Mari kelola data master dengan efisien hari ini!</p>
    </div>
</div>

<!-- Data Master Section -->
<div class="section-wrapper">
    <div class="section-header-inline">
        <h2>Data Master</h2>
        <!-- <a href="#" class="btn-view-all">View All</a> -->
    </div>

    <div class="cards-grid">
        <div class="data-card">
            <div class="card-icon icon-blue"><i class="bi bi-tag-fill"></i></div>
            <h4>Jenis Hewan</h4>
            <p>({{ $totalJenisHewan ?? 12 }} Data)</p>
            <a href="{{ route('admin.jenis-hewan.index') }}" class="card-link"></a>
        </div>

        <div class="data-card">
            <div class="card-icon icon-orange"><i class="bi bi-tags-fill"></i></div>
            <h4>Ras Hewan</h4>
            <p>({{ $totalRasHewan ?? 35 }} Data)</p>
            <a href="{{ route('admin.ras-hewan.index') }}" class="card-link"></a>
        </div>

        <div class="data-card">
            <div class="card-icon icon-pink"><i class="bi bi-folder-fill"></i></div>
            <h4>Kategori</h4>
            <p>({{ $totalKategori ?? 18 }} Data)</p>
            <a href="{{ route('admin.kategori.index') }}" class="card-link"></a>
        </div>

        <div class="data-card">
            <div class="card-icon icon-teal"><i class="bi bi-clipboard-pulse"></i></div>
            <h4>Kategori Klinis</h4>
            <p>({{ $totalKategoriKlinis ?? 2 }} Data)</p>
            <a href="{{ route('admin.kategori-klinis.index') }}" class="card-link"></a>
        </div>

        <div class="data-card">
            <div class="card-icon icon-purple"><i class="bi bi-file-medical-fill"></i></div>
            <h4>Kode Tindakan</h4>
            <p>({{ $totalKodeTindakan ?? 45 }} Data)</p>
            <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="card-link"></a>
        </div>

        <!-- <div class="data-card">
            <div class="card-icon icon-red"><i class="bi bi-heart-fill"></i></div>
            <h4>Pet</h4>
            <p>({{ $totalPet ?? 128 }} Data)</p>
            <a href="{{ route('admin.pet.index') }}" class="card-link"></a>
        </div> -->
    </div>
</div>

<!-- Management Progress Section -->
<div class="section-wrapper">
    <div class="section-header-inline">
        <h2>Management Progress</h2>
        <!-- <a href="#" class="btn-view-all">View All</a> -->
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Module</th>
                    <th>Total Data</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="table-cell-content">
                            <i class="bi bi-people-fill"></i>
                            <span>User Management</span>
                        </div>
                    </td>
                    <td>{{ $totalUsers ?? 24 }} Users</td>
                    <td>
                        <a href="{{ route('admin.user.index') }}" class="btn-action">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="table-cell-content">
                            <i class="bi bi-shield-fill-check"></i>
                            <span>Role Management</span>
                        </div>
                    </td>
                    <td>{{ $totalRoles ?? 5 }} Roles</td>
                    <td>
                        <a href="{{ route('admin.role.index') }}" class="btn-action">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>
                <tr class="row-highlighted">
                    <td>
                        <div class="table-cell-content">
                            <i class="bi bi-tag-fill"></i>
                            <span>Jenis Hewan</span>
                        </div>
                    </td>
                    <td>{{ $totalJenisHewan ?? 12 }} Types</td>
                    <td>
                        <a href="{{ route('admin.jenis-hewan.index') }}" class="btn-action">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="table-cell-content">
                            <i class="bi bi-tags-fill"></i>
                            <span>Ras Hewan</span>
                        </div>
                    </td>
                    <td>{{ $totalRasHewan ?? 35 }} Breeds</td>
                    <td>
                        <a href="{{ route('admin.ras-hewan.index') }}" class="btn-action">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="table-cell-content">
                            <i class="bi bi-folder-fill"></i>
                            <span>Kategori</span>
                        </div>
                    </td>
                    <td>{{ $totalKategori ?? 18 }} Categories</td>
                    <td>
                        <a href="{{ route('admin.kategori.index') }}" class="btn-action">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="table-cell-content">
                            <i class="bi bi-heart-fill"></i>
                            <span>Pet Management</span>
                        </div>
                    </td>
                    <td>{{ $totalPet ?? 128 }} Pets</td>
                    <td>
                        <a href="{{ route('admin.pet.index') }}" class="btn-action">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('styles')
<style>
    .greeting-banner {
        background: linear-gradient(135deg, #6c63ff 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 40px;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 6px 20px rgba(108, 99, 255, 0.3);
    }

    .greeting-banner h1 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .greeting-subtitle {
        font-size: 14px;
        opacity: 0.9;
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
    }

    .btn-view-all {
        padding: 8px 18px;
        border: 1.5px solid #6c63ff;
        border-radius: 10px;
        color: #6c63ff;
        text-decoration: none;
        transition: 0.3s;
        font-weight: 600;
    }

    .btn-view-all:hover {
        background: #6c63ff;
        color: #fff;
    }

    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
    }

    .data-card {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        transition: 0.3s;
    }

    .data-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 6px 20px rgba(108, 99, 255, 0.15);
    }

    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin: 0 auto 10px;
        font-size: 26px;
    }

    .icon-blue { background: #3b82f6; }
    .icon-orange { background: #f59e0b; }
    .icon-pink { background: #ec4899; }
    .icon-teal { background: #14b8a6; }
    .icon-purple { background: #8b5cf6; }
    .icon-red { background: #ef4444; }

    .data-card h4 {
        font-size: 16px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 5px;
    }

    .data-card p {
        color: #6b7280;
        font-size: 13px;
        margin: 0;
    }

    .table-container {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table th, .data-table td {
        padding: 16px 20px;
        text-align: left;
        font-size: 14px;
    }

    .data-table thead {
        background: #f9fafb;
    }

    .data-table th {
        color: #6b7280;
        font-weight: 700;
    }

    .data-table td {
        color: #374151;
    }

    .data-table tr {
        border-bottom: 1px solid #f1f1f1;
    }

    .data-table tr:hover {
        background: #f9fafb;
    }

    .row-highlighted {
        background: #eef2ff !important;
    }

    .table-cell-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-cell-content i {
        color: #6c63ff;
        font-size: 18px;
    }

    .btn-action {
        color: #6c63ff;
        font-size: 20px;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-action:hover {
        color: #5b55e1;
        transform: scale(1.1);
    }
</style>
@endpush
