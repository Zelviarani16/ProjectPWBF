@extends('layouts.resepsionis')

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
        <p>Selamat bekerja di sistem RSHP Universitas Airlangga</p>
        <p class="greeting-subtitle">Pastikan pelayanan pasien dan temu dokter berjalan lancar hari ini!</p>
    </div>
</div>

<!-- Data Master Section -->
<div class="section-wrapper">
    <div class="section-header-inline">
        <h2>Data Management</h2>
    </div>

    <div class="cards-grid">
        <div class="data-card">
            <div class="card-icon icon-blue"><i class="bi bi-person-fill"></i></div>
            <h4>Data Pemilik</h4>
            <p>({{ $totalPemilik ?? 0 }} Data)</p>
            <a href="{{ route('admin.pemilik.index') }}" class="card-link"></a>
        </div>

        <div class="data-card">
            <div class="card-icon icon-green"><i class="bi bi-heart-fill"></i></div>
            <h4>Data Pet</h4>
            <p>({{ $totalPet ?? 0 }} Data)</p>
            <a href="{{ route('admin.pet.index') }}" class="card-link"></a>
        </div>

        <div class="data-card">
            <div class="card-icon icon-orange"><i class="bi bi-calendar-heart-fill"></i></div>
            <h4>Temu Dokter</h4>
            <p>({{ $totalTemuDokter ?? 0 }} Jadwal)</p>
            <a href="{{ route('resepsionis.temu-dokter.index') }}" class="card-link"></a>
        </div>
    </div>
</div>

<!-- Management Progress Section -->
<div class="section-wrapper">
    <div class="section-header-inline">
        <h2>Progress Management</h2>
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
                            <i class="bi bi-person-fill"></i>
                            <span>Data Pemilik</span>
                        </div>
                    </td>
                    <td>{{ $totalPemilik ?? 0 }} Pemilik</td>
                    <td>
                        <a href="{{ route('admin.pemilik.index') }}" class="btn-action">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>

                <tr class="row-highlighted">
                    <td>
                        <div class="table-cell-content">
                            <i class="bi bi-heart-fill"></i>
                            <span>Data Pet</span>
                        </div>
                    </td>
                    <td>{{ $totalPet ?? 0 }} Hewan</td>
                    <td>
                        <a href="{{ route('admin.pet.index') }}" class="btn-action">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>

                <tr>
                    <td>
                        <div class="table-cell-content">
                            <i class="bi bi-calendar-heart-fill"></i>
                            <span>Temu Dokter</span>
                        </div>
                    </td>
                    <td>{{ $totalTemuDokter ?? 0 }} Jadwal</td>
                    <td>
                        <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn-action">
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
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        border-radius: 20px;
        padding: 40px;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 6px 20px rgba(22, 163, 74, 0.3);
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
        box-shadow: 0 6px 20px rgba(22, 163, 74, 0.15);
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
    .icon-green { background: #22c55e; }

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
        background: #ecfdf5 !important;
    }

    .table-cell-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-cell-content i {
        color: #22c55e;
        font-size: 18px;
    }

    .btn-action {
        color: #22c55e;
        font-size: 20px;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-action:hover {
        color: #16a34a;
        transform: scale(1.1);
    }
</style>
@endpush
