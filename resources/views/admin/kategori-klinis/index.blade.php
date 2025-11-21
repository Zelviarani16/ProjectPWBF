@extends('layouts.admin')

@section('title', 'Daftar Kategori Klinis')
@section('page-title', 'Kategori Klinis')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Daftar Kategori Klinis</h1>
    <p class="page-subtitle-custom">Kelola kategori klinis di sistem</p>
</div>

<div class="card-custom">
    <div class="card-header-custom">
        <h5 class="card-title-custom">
            <i class="bi bi-collection"></i> Data Kategori Klinis
        </h5>
        <a href="{{ route('admin.kategori-klinis.create') }}" class="btn-primary-custom">
            <i class="bi bi-plus-circle"></i> Tambah Kategori Klinis
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori Klinis</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoriKlinis as $kk)
                        <tr>
                            <td><span class="badge-id-custom">{{ $kk->idkategori_klinis }}</span></td>
                            <td>{{ $kk->nama_kategori_klinis }}</td>
                            <td>
                                <div class="action-buttons-custom">
                                    <a href="{{ route('admin.kategori-klinis.edit', $kk->idkategori_klinis) }}" class="btn-warning-custom">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.kategori-klinis.destroy', $kk->idkategori_klinis) }}" 
                                        method="POST" style="display:inline;"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori: {{ $kk->nama_kategori_klinis }}?')">

                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger-custom">
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
                                    <p>Belum ada data kategori klinis</p>
                                    <a href="{{ route('admin.kategori-klinis.create') }}" class="btn-primary-custom">
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

<div class="row mt-4">
    <div class="col-md-6 mb-3">
        <div class="stats-card-custom">
            <div>
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Total Kategori Klinis</p>
                <h3 class="mb-0">{{ $kategoriKlinis->count() }}</h3>
            </div>
            <div class="stats-icon-custom purple">
                <i class="bi bi-grid-3x3-gap"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="stats-card-custom recent">
            <div>
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Kategori Klinis Terbaru</p>
                <h6 class="mb-0">{{ $kategoriKlinis->last()->nama_kategori_klinis ?? '-' }}</h6>
            </div>
            <div class="stats-icon-custom green">
                <i class="bi bi-clock-history"></i>
            </div>
        </div>
    </div>
</div>


@endsection
