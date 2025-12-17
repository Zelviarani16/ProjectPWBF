@extends('layouts.lte.main')

@section('title', 'Daftar Ras Hewan')
@section('page-title', 'Ras Hewan')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Daftar Ras Hewan</h3>
                <p class="text-muted">Kelola data ras hewan berdasarkan jenis hewan yang tersedia di klinik</p>
            </div>
        </div>
    </div>
</div>
<!-- /App Content Header -->

<!-- App Content -->
<div class="app-content">
    <div class="container-fluid">

        <!-- Table Card -->
        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">

                    <div class="card-header">
                        <!-- <h3 class="card-title">Data Ras Hewan</h3> -->

                        <div class="card-tools">
                            <a href="{{ route('admin.ras-hewan.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle"></i> Tambah Ras Hewan
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 80px;">ID</th>
                                    <th>Nama Ras</th>
                                    <th>Jenis Hewan</th>
                                    <th style="width: 160px;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                @forelse($rasHewan as $r)
                                <tr>
                                    <td>{{ $r->idras_hewan }}</td>
                                    <td>{{ $r->nama_ras }}</td>

                                    <!-- <td>{{ $r->jenisHewan->nama_jenis_hewan ?? '-' }}</td> -->
                                    <td>{{ $r->nama_jenis_hewan }}</td>

                                    <td>
                                        <div class="btn-group">

                                            <a href="{{ route('admin.ras-hewan.edit', $r->idras_hewan) }}"
                                               class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('admin.ras-hewan.destroy', $r->idras_hewan) }}"
                                                  method="POST"
                                                  style="display:inline;"
                                                  onsubmit="return confirm('Yakin ingin menghapus {{ $r->nama_ras }}?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox"></i>
                                        <p class="mb-2">Belum ada data ras hewan</p>
                                        <a href="{{ route('admin.ras-hewan.create') }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-plus-circle"></i> Tambah Data
                                        </a>
                                    </td>
                                </tr>
                                @endforelse

                            </tbody>

                        </table>
                    </div>

                </div>

            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mt-4">

            <div class="col-md-6 mb-3">
                <div class="info-box bg-purple">
                    <span class="info-box-icon">
                        <i class="bi bi-grid-3x3-gap"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Ras Hewan</span>
                        <span class="info-box-number">{{ $rasHewan->count() }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="info-box bg-success">
                    <span class="info-box-icon">
                        <i class="bi bi-clock-history"></i>
                    </span>

                    <div class="info-box-content">
                        <span class="info-box-text">Ras Terbaru</span>
                        <span class="info-box-number">{{ $rasHewan->first()->nama_ras ?? '-' }}</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
<!-- /App Content -->

@endsection
