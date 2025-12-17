@extends('layouts.lte.main')

@section('title', 'Rekam Medis')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Rekam Medis</h3>
                <p class="text-muted">Lihat rekam medis hewan peliharaan Anda</p>
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
                        <h3 class="card-title mb-0">
                            <i class="bi bi-file-medical"></i> Rekam Medis
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">

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
                                @forelse($rekamMedis as $rm)
                                    <tr>
                                        <td>{{ $rm->idrekam_medis }}</td>
                                        <td>{{ \Carbon\Carbon::parse($rm->created_at)->format('d/m/Y H:i') }}</td>
                                        <td>{{ $rm->idreservasi_dokter }}</td>
                                        <td>{{ $rm->nama_hewan ?? '-' }}</td>
                                        <td>{{ $rm->anamnesa ?? '-' }}</td>
                                        <td>{{ $rm->temuan_klinis ?? '-' }}</td>
                                        <td>{{ $rm->diagnosa ?? '-' }}</td>
                                        <td>{{ $rm->nama_dokter ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('pemilik.rekam-medis.detail', $rm->idrekam_medis) }}"
                                            class="btn btn-primary btn-sm">
                                                Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-2"></i>
                                            <p class="mt-2 mb-0">Belum ada rekam medis</p>
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
                    <span class="info-box-icon"><i class="bi bi-file-medical"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Rekam Medis</span>
                        <span class="info-box-number">{{ $rekamMedis->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Stats Cards -->

    </div>
</div>

@endsection
