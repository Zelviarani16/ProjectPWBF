@extends('layouts.lte.main')

@section('title', 'Data Pasien')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Data Pasien</h3>
                <p class="text-muted">Lihat semua data pasien hewan</p>
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
                        <h3 class="card-title mb-0"><i class="bi bi-clipboard-data"></i> Pasien</h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Hewan</th>
                                        <th>Ras</th>
                                        <th>Jenis Hewan</th>
                                        <th>Nama Pemilik</th>
                                        <th>Email Pemilik</th>
                                        <th>No WA</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pasien as $p)
                                        <tr>
                                            <td>{{ $p->idpet }}</td>
                                            <td>{{ $p->nama }}</td>
                                            <td>{{ optional($p->ras)->nama_ras ?? '-' }}</td>
                                            <td>{{ optional($p->ras->jenisHewan)->nama_jenis_hewan ?? '-' }}</td>
                                            <td>{{ optional($p->pemilik->user)->nama ?? '-' }}</td>
                                            <td>{{ optional($p->pemilik->user)->email ?? '-' }}</td>
                                            <td>{{ optional($p->pemilik)->no_wa ?? '-' }}</td>
                                            <td>{{ optional($p->pemilik)->alamat ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">
                                                <i class="bi bi-inbox fs-2"></i>
                                                <p class="mt-2 mb-2">Belum ada data pasien</p>
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
                    <span class="info-box-icon"><i class="bi bi-grid-3x3-gap"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pasien</span>
                        <span class="info-box-number">{{ $pasien->count() }}</span>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Stats Cards -->

    </div>
</div>

@endsection
