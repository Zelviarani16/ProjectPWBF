@extends('layouts.admin')

@section('title', 'Daftar Temu Dokter')
@section('page-title', 'Temu Dokter')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Daftar Reservasi Temu Dokter</h1>
    <p class="page-subtitle-custom">Kelola semua reservasi temu dokter</p>
</div>

<div class="card-custom">
    <div class="card-header-custom">
        <h5 class="card-title-custom"><i class="bi bi-journal-medical"></i> Reservasi</h5>
        <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn-primary-custom">
            <i class="bi bi-plus-circle"></i> Tambah Reservasi
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>No Urut</th>
                        <th>Waktu Daftar</th>
                        <th>Pemilik</th>
                        <th>Pet</th>
                        <th>Dokter</th>
                        <th>Status</th>
                        <th style="width:150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservasi as $r)
                        <tr>
                            <td>{{ $r->no_urut }}</td>
                            <td>{{ \Carbon\Carbon::parse($r->waktu_daftar)->format('d M Y H:i') }}</td>
                            <td>{{ $r->pet->pemilik->user->nama ?? '-' }}</td>
                            <td>{{ $r->pet->nama ?? '-' }}</td>
                            <td>{{ $r->roleUser->user->nama ?? '-' }}</td>
                            <td>{{ $r->status }}</td>
                            <td>
                                <div class="action-buttons-custom">
                                    <a href="{{ route('resepsionis.temu-dokter.edit', $r->idreservasi_dokter) }}" class="btn-warning-custom"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('resepsionis.temu-dokter.destroy', $r->idreservasi_dokter) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger-custom" onclick="return confirm('Yakin ingin hapus reservasi ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state-custom">
                                    <i class="bi bi-inbox"></i>
                                    <p>Belum ada data reservasi</p>
                                    <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn-primary-custom">
                                        <i class="bi bi-plus-circle"></i> Tambah Reservasi
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
@endsection
