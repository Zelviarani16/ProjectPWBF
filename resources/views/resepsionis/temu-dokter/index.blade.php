@extends('layouts.lte.main')

@section('title', 'Daftar Temu Dokter')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Daftar Reservasi Temu Dokter</h3>
                <p class="text-muted">Kelola semua reservasi temu dokter</p>
            </div>
        </div>
    </div>
</div>
<!-- /App Content Header -->

<!-- App Content -->
<div class="app-content">
    <div class="container-fluid">

        <!-- Table -->
        <div class="row">
            <div class="col-md-12">

                <div class="card mb-4">

                    <div class="card-header">
                        <div class="card-tools">
                            <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle"></i> Tambah Reservasi
                            </a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
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
                                        <td>{{ $r->idreservasi_dokter }}</td>
                                        <td>{{ $r->no_urut }}</td>
                                        <td>{{ \Carbon\Carbon::parse($r->waktu_daftar)->format('d M Y H:i') }}</td>
                                        <td>{{ optional($r->pet->pemilik->user)->nama ?? '-' }}</td>
                                        <td>{{ optional($r->pet)->nama ?? '-' }}</td>
                                        <td>{{ optional($r->roleUser->user)->nama ?? '-' }}</td>

                                        <td>
                                            @if($r->status == 'A')
                                                <span class="badge bg-warning">
                                                    Antrian
                                                </span>
                                            @elseif($r->status == 'P')
                                                <span class="badge bg-primary">
                                                    Diproses
                                                </span>
                                            @elseif($r->status == 'S')
                                                <span class="badge bg-success">
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">-</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('resepsionis.temu-dokter.edit', $r->idreservasi_dokter) }}"
                                                   class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <form action="{{ route('resepsionis.temu-dokter.destroy', $r->idreservasi_dokter) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin hapus reservasi ini?')">
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
                                        <td colspan="8" class="text-center py-4 text-muted">
                                            <i class="bi bi-inbox fs-4"></i>
                                            <p class="mb-2">Belum ada data reservasi</p>
                                            <a href="{{ route('resepsionis.temu-dokter.create') }}"
                                               class="btn btn-primary btn-sm">
                                                <i class="bi bi-plus-circle"></i> Tambah Reservasi
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

            <div class="col-md-4 mb-3">
                <div class="info-box bg-primary">
                    <span class="info-box-icon">
                        <i class="bi bi-list-ol"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Reservasi</span>
                        <span class="info-box-number">{{ $reservasi->count() }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="info-box bg-warning">
                    <span class="info-box-icon">
                        <i class="bi bi-hourglass-split"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Antrian</span>
                        <span class="info-box-number">
                            {{ $reservasi->where('status','A')->count() }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="info-box bg-success">
                    <span class="info-box-icon">
                        <i class="bi bi-check-circle"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Selesai</span>
                        <span class="info-box-number">
                            {{ $reservasi->where('status','S')->count() }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Stats Cards -->

    </div>
</div>
<!-- /App Content -->

@endsection
