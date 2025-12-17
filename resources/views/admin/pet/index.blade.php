@extends('layouts.lte.main')

@section('title', 'Daftar Pet')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Daftar Pet</h3>
                <p class="text-muted">Kelola data hewan peliharaan beserta pemiliknya</p>
            </div>
        </div>
    </div>
</div>
<!-- /App Content Header -->

<!-- App Content -->
<div class="app-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">

                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ route('admin.pet.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle"></i> Tambah
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:70px;">ID</th>
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
                                                <span class="badge text-white d-inline-flex align-items-center gap-1"
                                                      style="background-color:#e83e8c;">
                                                    <i class="bi bi-gender-female"></i> Betina
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">Tidak Diketahui</span>
                                            @endif
                                        </td>
                                        <td>{{ $pet->nama_ras ?? '-' }}</td>
                                        <td>{{ $pet->nama_pemilik ?? '-' }}</td>
                                        <td>
                                            <div class="btn-group">

                                                <!-- Edit -->
                                                <a href="{{ route('admin.pet.edit', $pet->idpet) }}"
                                                   class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <!-- Delete -->
                                                <form action="{{ route('admin.pet.destroy', $pet->idpet) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin menghapus pet: {{ $pet->nama }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-4"></i>
                                            <p class="mb-2">Belum ada data pet</p>
                                            <a href="{{ route('admin.pet.create') }}" class="btn btn-primary btn-sm">
                                                <i class="bi bi-plus-circle"></i> Tambah Data
                                            </a>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mt-4">

            <div class="col-md-6 mb-3">
                <div class="info-box bg-purple">
                    <span class="info-box-icon">
                        <i class="bi bi-grid-3x3-gap"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Kategori Klinis</span>
                        <span class="info-box-number">{{ $pets->count() }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="info-box bg-success">
                    <span class="info-box-icon">
                        <i class="bi bi-clock-history"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Kategori Klinis Terbaru</span>
                        <span class="info-box-number">{{ $pets->last()->nama ?? '-' }}</span>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Stats Cards -->

    </div>
</div>

@endsection
