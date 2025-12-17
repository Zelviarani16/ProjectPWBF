@extends('layouts.lte.main')

@section('title', 'Data Rekam Medis')

@section('content')
<div class="app-content-header">
    <div class="container-fluid">
        <h3>Data Rekam Medis</h3>
        <p class="text-muted">Kelola semua rekam medis pasien hewan</p>
    </div>
</div>

<div class="app-content container-fluid">

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Rekam Medis</span>
            <a href="{{ route('perawat.rekam-medis.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-circle"></i> Tambah Anamnesa
            </a>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal Dibuat</th>
                        <th>ID Reservasi</th>
                        <th>Nama Hewan</th>
                        <th>Anamnesa</th>
                        <th>Status</th>
                        <th>Dokter Pemeriksa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekam as $r)
                        <tr>
                            <td>{{ $r->idrekam_medis }}</td>
                            <td>{{ $r->created_at ? \Carbon\Carbon::parse($r->created_at)->format('d/m/Y H:i') : '-' }}</td>
                            <td>{{ $r->idreservasi_dokter }}</td>
                            <td>{{ $r->nama_hewan ?? '-' }}</td>
                            <td>{{ Str::limit($r->anamnesa, 50) }}</td>
                            <td>{{ $r->status }}</td>
                            <td>{{ $r->nama_dokter ?? '-' }}</td>
                            <td>
                                <a href="{{ route('perawat.rekam-medis.edit', $r->idrekam_medis) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('perawat.rekam-medis.detail', $r->idrekam_medis) }}" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Belum ada rekam medis</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
