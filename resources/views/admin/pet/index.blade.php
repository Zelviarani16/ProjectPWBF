@extends('layouts.admin')

@section('title', 'Daftar Pet')
@section('page-title', 'Pet')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Daftar Pet</h1>
    <p class="page-subtitle-custom">Kelola data hewan peliharaan beserta pemiliknya</p>
</div>

<div class="card-custom">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <h5 class="card-title-custom"><i class="bi bi-collection"></i> Data Pet</h5>
        <a href="{{ route('admin.pet.create') }}" class="btn-primary-custom">
            <i class="bi bi-plus-circle"></i> Tambah Pet
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Pet</th>
                        <th>Tanggal Lahir</th>
                        <th>Warna / Tanda</th>
                        <th>Jenis Kelamin</th>
                        <th>Ras Hewan</th>
                        <th>Pemilik</th>
                        <th style="width:150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pets as $pet)
                        <tr>
                            <td>{{ $pet->idpet }}</td>
                            <td>{{ $pet->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d M Y') }}</td>
                            <td>{{ $pet->warna_tanda ?? '-' }}</td>
                            <td>
                                @if($pet->jenis_kelamin == 'L')
                                    <span class="badge bg-primary d-inline-flex align-items-center gap-1">
                                        <i class="bi bi-gender-male"></i> Jantan
                                    </span>
                                @elseif($pet->jenis_kelamin == 'P')
                                    <span class="badge text-white d-inline-flex align-items-center gap-1" style="background-color:#e83e8c;">
                                        <i class="bi bi-gender-female"></i> Betina
                                    </span>
                                @else
                                    <span class="badge bg-secondary">Tidak Diketahui</span>
                                @endif
                            </td>
                            <td>{{ $pet->nama_ras ?? '-' }}</td>
                            <td>{{ $pet->nama_pemilik ?? '-' }}</td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('admin.pet.edit', $pet->idpet) }}" class="btn-warning-custom" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.pet.destroy', $pet->idpet) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pet: {{ $pet->nama }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger-custom" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="empty-state-custom">
                                    <i class="bi bi-inbox fs-2"></i>
                                    <p class="mt-2 mb-2">Belum ada data pet</p>
                                    <a href="{{ route('admin.pet.create') }}" class="btn-primary-custom">
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
                <h3 class="mb-0">{{ $pets->count() }}</h3>
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
                <h6 class="mb-0">{{ $pets->last()->nama ?? '-' }}</h6>
            </div>
            <div class="stats-icon-custom green">
                <i class="bi bi-clock-history"></i>
            </div>
        </div>
    </div>
</div>



@endsection
