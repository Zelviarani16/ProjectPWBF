@extends('layouts.admin')

@section('title', 'Daftar Ras Hewan')
@section('page-title', 'Ras Hewan')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Daftar Ras Hewan</h1>
    <p class="page-subtitle-custom">Kelola data ras hewan berdasarkan jenis hewan yang tersedia di klinik</p>
</div>

<div class="card-custom">
    <div class="card-header-custom">
        <h5 class="card-title-custom">
            <i class="bi bi-list-ul"></i> Data Ras Hewan
        </h5>
        <a href="{{ route('admin.ras-hewan.create') }}" class="btn-primary-custom">
            <i class="bi bi-plus-circle"></i> Tambah Ras Hewan
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Ras</th>
                        <th>Jenis Hewan</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rasHewan as $r)
                        <tr>
                            <td><span class="badge-id-custom">{{ $r->idras_hewan }}</span></td>
                            <td>{{ $r->nama_ras }}</td>
                            <!-- <td>{{ $r->jenisHewan->nama_jenis_hewan ?? '-' }}</td> -->
                            <td>{{ $r->nama_jenis_hewan }}</td>

                            <td>
                                <div class="action-buttons-custom">
                                    <a href="{{ route('admin.ras-hewan.edit', $r->idras_hewan) }}" class="btn-warning-custom">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.ras-hewan.destroy', $r->idras_hewan) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger-custom" onclick="return confirm('Yakin ingin menghapus {{ $r->nama_ras }}?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state-custom">
                                    <i class="bi bi-inbox"></i>
                                    <p>Belum ada data ras hewan</p>
                                    <a href="{{ route('admin.ras-hewan.create') }}" class="btn-primary-custom">
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
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Total Ras Hewan</p>
                <h3 class="mb-0">{{ $rasHewan->count() }}</h3>
            </div>
            <div class="stats-icon-custom purple">
                <i class="bi bi-grid-3x3-gap"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="stats-card-custom recent">
            <div>
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Ras Terbaru</p>
                <h6 class="mb-0">{{ $rasHewan->last()->nama_ras ?? '-' }}</h6>
            </div>
            <div class="stats-icon-custom green">
                <i class="bi bi-clock-history"></i>
            </div>
        </div>
    </div>
</div>
@endsection
