@extends('layouts.admin')

@section('title', 'Daftar Kode Tindakan Terapi')
@section('page-title', 'Kode Tindakan Terapi')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Daftar Kode Tindakan Terapi</h1>
    <p class="page-subtitle-custom">Kelola data kode tindakan terapi beserta kategori dan kategori klinisnya</p>
</div>

<div class="card-custom">
    <div class="card-header-custom">
        <h5 class="card-title-custom"><i class="bi bi-collection"></i> Data Kode Tindakan Terapi</h5>
        <a href="{{ route('admin.kode-tindakan-terapi.create') }}" class="btn-primary-custom">
            <i class="bi bi-plus-circle"></i> Tambah Kode
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Kategori Klinis</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kodeTindakanTerapi as $kode)
                        <tr>
                            <td><span class="badge-id-custom">{{ $kode->idkode_tindakan_terapi }}</span></td>
                            <td>{{ $kode->kode }}</td>
                            <td>{{ $kode->deskripsi_tindakan_terapi }}</td>
                            <td>{{ $kode->nama_kategori }}</td>
                            <td>{{ $kode->nama_kategori_klinis }}</td>
                            <td>
                                <div class="action-buttons-custom">
                                    <a href="{{ route('admin.kode-tindakan-terapi.edit', $kode->idkode_tindakan_terapi) }}" class="btn-warning-custom">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.kode-tindakan-terapi.destroy', $kode->idkode_tindakan_terapi) }}" method="POST" style="display:inline;"
                                          onsubmit="return confirm('Yakin ingin menghapus kode: {{ $kode->kode }}?')">
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
                            <td colspan="6">
                                <div class="empty-state-custom">
                                    <i class="bi bi-inbox"></i>
                                    <p>Belum ada data kode tindakan terapi</p>
                                    <a href="{{ route('admin.kode-tindakan-terapi.create') }}" class="btn-primary-custom">
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
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Total Kode Tindakan Terapi</p>
                <h3 class="mb-0">{{ $kodeTindakanTerapi->count() }}</h3>
            </div>
            <div class="stats-icon-custom purple">
                <i class="bi bi-grid-3x3-gap"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="stats-card-custom recent">
            <div>
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Kode Tindakan Terapi Terbaru</p>
                <h6 class="mb-0">{{ $kodeTindakanTerapi->last()->deskripsi_tindakan_terapi ?? '-' }}</h6>
            </div>
            <div class="stats-icon-custom green">
                <i class="bi bi-clock-history"></i>
            </div>
        </div>
    </div>
</div>
@endsection
