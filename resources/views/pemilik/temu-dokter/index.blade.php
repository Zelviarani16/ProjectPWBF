@extends('layouts.lte.main')

@section('title', 'Jadwal Temu Dokter')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Jadwal Temu Dokter</h3>
                <p class="text-muted">Lihat jadwal kunjungan untuk hewan peliharaan Anda</p>
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
                            <i class="bi bi-calendar-check"></i> Jadwal Temu Dokter
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Hewan</th>
                                        <th>Waktu Daftar</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($jadwal as $j)
                                        <tr>
                                            <td>{{ $j->idreservasi_dokter }}</td>
                                            <td>{{ $j->pet->nama ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($j->waktu_daftar)->format('d M Y H:i') }}</td>
                                            <td>{{ $j->status }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                <i class="bi bi-inbox fs-2"></i>
                                                <p class="mt-2 mb-0">Belum ada jadwal temu dokter</p>
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
