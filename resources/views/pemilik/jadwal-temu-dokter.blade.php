r@extends('layouts.admin')

@section('title', 'Jadwal Temu Dokter')
@section('page-title', 'Jadwal Temu Dokter')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Jadwal Temu Dokter</h1>
    <p class="page-subtitle-custom">Lihat jadwal kunjungan untuk hewan peliharaan Anda</p>
</div>

<div class="card-custom">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-custom">
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
                            <td colspan="4" class="text-center py-4">
                                <div class="empty-state-custom">
                                    <i class="bi bi-inbox fs-2"></i>
                                    <p class="mt-2 mb-2">Belum ada jadwal temu dokter</p>
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
