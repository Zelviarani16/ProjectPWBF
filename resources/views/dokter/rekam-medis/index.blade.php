@extends('layouts.lte.main')

@section('title', 'Data Rekam Medis')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Data Rekam Medis</h3>
                <p class="text-muted">Kelola semua rekam medis pasien hewan</p>
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
                        <h3 class="card-title mb-0"><i class="bi bi-clipboard-data"></i> Rekam Medis</h3>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
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
                                        <th style="width:180px;"> Aksi </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rekam as $r)
                                        <tr>
                                            <td>{{ $r->idrekam_medis }}</td>
                                            <td>{{ \Carbon\Carbon::parse($r->created_at)->format('d/m/Y H:i') }}</td>
                                            <td>{{ $r->idreservasi_dokter }}</td>
                                            <td>{{ $r->nama_pet ?? '-' }}</td>
                                            <td>{{ Str::limit($r->anamnesa, 50) }}</td>
                                            <td>{{ Str::limit($r->temuan_klinis, 50) }}</td>
                                            <td>{{ Str::limit($r->diagnosa, 50) }}</td>
                                            <td>{{ $r->nama_dokter }}</td>
                                            <td>
                                                <a href="{{ route('dokter.rekam-medis.showDetail', $r->idrekam_medis) }}" 
                                                   class="btn btn-info btn-sm" title="Lihat Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted py-4">
                                                <i class="bi bi-inbox fs-2 mb-2"></i>
                                                <p class="mt-2 mb-2">Belum ada data rekam medis</p>
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
                        <span class="info-box-text">Total Rekam Medis</span>
                        <span class="info-box-number">{{ $rekam->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Stats Cards -->

    </div>
</div>

@endsection
