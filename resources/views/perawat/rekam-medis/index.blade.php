@extends('layouts.admin')

@section('title', 'Data Rekam Medis')
@section('page-title', 'Rekam Medis')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Data Rekam Medis</h1>
    <p class="page-subtitle-custom">Kelola semua rekam medis pasien hewan</p>
</div>

{{-- Alert Success/Error --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card-custom">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <h5 class="card-title-custom"><i class="bi bi-file-medical"></i> Rekam Medis</h5>
        <a href="{{ route('perawat.rekam-medis.create') }}" class="btn-primary-custom">
            <i class="bi bi-plus-circle"></i> Tambah Rekam Medis
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal Dibuat</th>
                        <th>ID Reservasi</th>
                        <th>Nama Hewan</th>
                        <th>Anamnesa</th>
                        <th>Temuan Klinis</th>
                        <th>Diagnosa</th>
                        <th>Dokter Pemeriksa</th>
                        <th style="width:180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekam as $r)
                        <tr>
                            <td>{{ $r->idrekam_medis }}</td>
                            {{-- Tampilkan created_at dari rekam_medis --}}
                            <td>{{ $r->created_at ? $r->created_at->format('d/m/Y H:i') : '-' }}</td>
                            <td>{{ $r->idreservasi_dokter }}</td>
                            <td>{{ optional($r->reservasi->pet)->nama ?? '-' }}</td>
                            <td>{{ Str::limit($r->anamnesa, 50) }}</td>
                            <td>{{ Str::limit($r->temuan_klinis, 50) }}</td>
                            <td>{{ Str::limit($r->diagnosa, 50) }}</td>
                            {{-- Pakai accessor nama_dokter --}}
                            <td>{{ $r->nama_dokter }}</td>
                            <td>
                                <div class="action-buttons-custom">
                                    <a href="{{ route('perawat.rekam-medis.edit', $r->idrekam_medis) }}" 
                                       class="btn-warning-custom" 
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('perawat.rekam-medis.destroy', $r->idrekam_medis) }}" 
                                          method="POST" 
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn-danger-custom" 
                                                title="Hapus"
                                                onclick="return confirm('Yakin ingin menghapus rekam medis ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    <a href="{{ route('perawat.rekam-medis.detail', $r->idrekam_medis) }}" 
                                       class="btn-info-custom"
                                       title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state-custom text-center py-4">
                                    <i class="bi bi-inbox fs-1 mb-2"></i>
                                    <p class="mb-0">Belum ada data rekam medis</p>
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
        <div class="stats-card-custom d-flex justify-content-between align-items-center">
            <div>
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Total Rekam Medis</p>
                <h3 class="mb-0">{{ $rekam->count() }}</h3>
            </div>
            <div class="stats-icon-custom purple">
                <i class="bi bi-grid-3x3-gap"></i>
            </div>
        </div>
    </div>
</div>
@endsection