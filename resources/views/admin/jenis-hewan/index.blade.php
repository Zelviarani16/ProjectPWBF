
@extends('layouts.admin')

@section('title', 'Daftar Jenis Hewan')
@section('page-title', 'Jenis Hewan')

@section('content')
<div id="jenis-hewan-page">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Daftar Jenis Hewan</h1>
        <p class="page-subtitle-custom">Kelola data jenis hewan yang tersedia di klinik</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom">
            <h5 class="card-title-custom">
                <i class="bi bi-grid-3x3-gap"></i> Data Jenis Hewan
            </h5>
            <a href="{{ route('admin.jenis-hewan.create') }}" class="btn-primary-custom">
                <i class="bi bi-plus-circle"></i> Tambah Jenis Hewan
            </a>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th style="width: 100px;">ID</th>
                            <th>Nama Jenis Hewan</th>
                            <th style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jenisHewan as $jenis)
                        <!-- artinya, loop pertama $jenis berisi data baris pertama (misal ID=1, Sapi) . -->
                        <!-- Jadi blade sudah memegang ID per-baris melalui variabel $jenis -->
                        <tr>
                            <td>
                                <span class="badge-id-custom">{{ $jenis->idjenis_hewan }}</span>
                            </td>
                            <td class="animal-name-custom">
                                {{ $jenis->nama_jenis_hewan }}
                            </td>
                            <td>
                                <div class="action-buttons-custom">
                                    <a href="{{ route('admin.jenis-hewan.edit', $jenis->idjenis_hewan) }}" 
                                       class="btn-warning-custom btn-sm-custom"
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.jenis-hewan.destroy', $jenis->idjenis_hewan) }}" 
                                          method="POST" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Yakin ingin menghapus jenis hewan: {{ $jenis->nama_jenis_hewan }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn-danger-custom btn-sm-custom"
                                                title="Hapus">
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
                                    <p>Belum ada data jenis hewan</p>
                                    <a href="{{ route('admin.jenis-hewan.create') }}" class="btn-primary-custom" style="margin-top: 1rem;">
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

    <!-- Stats Cards -->
    <div class="row mt-4">
    <div class="col-md-6 mb-3">
        <div class="stats-card-custom">
            <div>
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Total Jenis Hewan</p>
                <h3 class="mb-0">{{ $jenisHewan->count() }}</h3>
            </div>
            <div class="stats-icon-custom purple">
                <i class="bi bi-grid-3x3-gap"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="stats-card-custom recent">
            <div>
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Jenis Hewan Terbaru</p>
                <h6 class="mb-0">{{ $jenisHewan->last()->nama_jenis_hewan ?? '-' }}</h6>
            </div>
            <div class="stats-icon-custom green">
                <i class="bi bi-clock-history"></i>
            </div>
        </div>
    </div>
</div>

@endsection
