@extends('layouts.admin')

@section('title', 'Daftar Pet')
@section('page-title', 'Pet')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Daftar Pet</h1>
    <p class="page-subtitle-custom">Kelola data hewan peliharaan beserta pemiliknya</p>
</div>

<div class="card-custom">
    <div class="card-header-custom">
        <h5 class="card-title-custom">
            <i class="bi bi-collection"></i> Data Pet
        </h5>
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
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pets as $p)
                        <tr>
                            <td><span class="badge-id-custom">{{ $p->idpet }}</span></td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d M Y') }}</td>
                            <td>{{ $p->warna_tanda ?? '-' }}</td>

                            {{-- Jenis Kelamin --}}
                            <td>
                                @php
                                    $jk = strtolower($p->jenis_kelamin);
                                @endphp

                                @if(in_array($jk, ['J', 'L', 'jantan']))
                                    <span class="badge bg-primary d-inline-flex align-items-center gap-1" style="width:fit-content;">
                                        <i class="bi bi-gender-male"></i> Jantan
                                    </span>
                                @elseif(in_array($jk, ['B', 'P', 'betina']))
                                    <span class="badge text-white d-inline-flex align-items-center gap-1" style="background-color:#e83e8c;width:fit-content;">
                                        <i class="bi bi-gender-female"></i> Betina
                                    </span>
                                @else
                                    <span class="badge bg-secondary">Tidak Diketahui</span>
                                @endif
                            </td>

                            {{-- Ras Hewan --}}
                            <td>{{ $p->nama_ras ?? '-' }}</td>

                            {{-- Pemilik --}}
                            <td>{{ $p->nama_pemilik ?? '-' }}</td>

                            {{-- Tombol Aksi --}}
                            <td>
                                <div class="action-buttons-custom">
                                    <a href="{{ route('admin.pet.edit', $p->idpet) }}" class="btn-warning-custom" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.pet.destroy', $p->idpet) }}" method="POST" style="display:inline;"
                                          onsubmit="return confirm('Yakin ingin menghapus pet: {{ $p->nama }}?')">
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
                            <td colspan="8">
                                <div class="empty-state-custom">
                                    <i class="bi bi-inbox"></i>
                                    <p>Belum ada data pet</p>
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

{{-- Stats --}}
<div class="row mt-4">
    <div class="col-md-6 mb-3">
        <div class="stats-card-custom">
            <div>
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Total Pet</p>
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
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Pet Terbaru</p>
                <h6 class="mb-0">{{ $pets->last()->nama ?? '-' }}</h6>
            </div>
            <div class="stats-icon-custom green">
                <i class="bi bi-clock-history"></i>
            </div>
        </div>
    </div>
</div>
@endsection
