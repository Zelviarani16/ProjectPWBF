@extends('layouts.lte.main')

@section('title', 'Daftar Kategori')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Daftar Kategori</h3>
                <p class="text-muted">Kelola kategori data di sistem</p>
            </div>
        </div>
    </div>
</div>
<!-- /App Content Header -->

<!-- App Content -->
<div class="app-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">

                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle"></i> Tambah
                            </a>
                        </div>
                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 80px;">ID</th>
                                    <th>Nama Kategori</th>
                                    <th style="width: 160px;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($kategori as $k)
                                <tr>
                                    <td>{{ $k->idkategori }}</td>
                                    <td>{{ $k->nama_kategori }}</td>
                                    <td>
                                        <div class="btn-group">

                                            <!-- Edit -->
                                            <a href="{{ route('admin.kategori.edit', $k->idkategori) }}"
                                               class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.kategori.destroy', $k->idkategori) }}"
                                                  method="POST"
                                                  style="display:inline;"
                                                  onsubmit="return confirm('Yakin ingin menghapus kategori {{ $k->nama_kategori }}?')">
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
                                    <td colspan="3" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox fs-4"></i>
                                        <p class="mb-2">Belum ada data kategori</p>
                                        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary btn-sm">
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
                        <span class="info-box-text">Total Kategori</span>
                        <span class="info-box-number">{{ $kategori->count() }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="info-box bg-success">
                    <span class="info-box-icon">
                        <i class="bi bi-clock-history"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Kategori Terbaru</span>
                        <span class="info-box-number">
                            {{ $kategori->last()->nama_kategori ?? '-' }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Stats Cards -->

    </div>
</div>
<!-- /App Content -->

@endsection
