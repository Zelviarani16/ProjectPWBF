@extends('layouts.admin')

@section('title', 'Daftar Kategori')
@section('page-title', 'Kategori')

@section('content')

<div id="data-page">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Daftar Kategori</h1>
        <p class="page-subtitle-custom">Kelola kategori data di sistem</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom">
            <h5 class="card-title-custom">
                <i class="bi bi-tag"></i> Data Kategori
            </h5>
            <a href="{{ route('admin.kategori.create') }}" class="btn-primary-custom">
                <i class="bi bi-plus-circle"></i> Tambah Kategori
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th style="width: 100px;">ID</th>
                            <th>Nama Kategori</th>
                            <th style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategori as $k)
                        <tr>
                            <td><span class="badge-id-custom">{{ $k->idkategori }}</span></td>
                            <td>{{ $k->nama_kategori }}</td>
                            <td>
                                <div class="action-buttons-custom">
                                    <a href="{{ route('admin.kategori.edit', $k->idkategori) }}" 
                                       class="btn-warning-custom" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>

                                    <form action="{{ route('admin.kategori.destroy', $k->idkategori) }}" 
                                          method="POST" style="display:inline;"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori: {{ $k->nama_kategori }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger-custom" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">
                                <div class="empty-state-custom">
                                    <i class="bi bi-inbox"></i>
                                    <p>Belum ada data kategori</p>
                                    <a href="{{ route('admin.kategori.create') }}" class="btn-primary-custom mt-2">
                                        <i class="bi bi-plus-circle"></i> Tambah Data
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Stats Card -->
   <div class="row mt-4">
    <div class="col-md-6 mb-3">
        <div class="stats-card-custom">
            <div>
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Total Kategori</p>
                <h3 class="mb-0">{{ $kategori->count() }}</h3>
            </div>
            <div class="stats-icon-custom purple">
                <i class="bi bi-grid-3x3-gap"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="stats-card-custom recent">
            <div>
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Kategori Terbaru</p>
                <h6 class="mb-0">{{ $kategori->last()->nama_kategori ?? '-' }}</h6>
            </div>
            <div class="stats-icon-custom green">
                <i class="bi bi-clock-history"></i>
            </div>
        </div>
    </div>
</div>

@endsection
