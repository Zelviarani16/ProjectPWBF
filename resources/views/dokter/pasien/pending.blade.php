@extends('layouts.lte.main')

@section('title', 'Daftar Pasien Pending')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Daftar Pasien (Status Pending)</h3>
                <p class="text-muted">Pasien yang menunggu untuk diperiksa</p>
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
                            <i class="bi bi-clock-history"></i> Antrian Pasien
                        </h3>
                    </div>


                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th>No Urut</th>
                                        <th>Waktu Daftar</th>
                                        <th>Nama Pet</th>
                                        <th>Pemilik</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($data as $item)
                                    <tr>
                                        <td>{{ $item->no_urut }}</td>
                                        <td>{{ $item->waktu_daftar }}</td>
                                        <td>{{ $item->pet->nama ?? '-' }}</td>
                                        <td>{{ $item->pet->pemilik->user->nama ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-warning text-dark">
                                                Pending
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('dokter.rekam-medis.periksa', $item->idreservasi_dokter) }}" 
                                            class="btn btn-success btn-sm" title="Periksa">
                                                <i class="bi bi-stethoscope"></i> Periksa
                                            </a>
                                        </td>
                                    </tr>

                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-2"></i>
                                            <p class="mt-2 mb-2">Tidak ada pasien yang menunggu</p>
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

    </div>
</div>

@endsection
