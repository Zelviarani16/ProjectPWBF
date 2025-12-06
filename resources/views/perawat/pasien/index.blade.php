@extends('layouts.admin')

@section('title', 'Data Pasien')
@section('page-title', 'Pasien')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Data Pasien</h1>
    <p class="page-subtitle-custom">Lihat semua data pasien hewan</p>
</div>

<div class="card-custom">
    <div class="card-header-custom">
        <h5 class="card-title-custom"><i class="bi bi-clipboard-data"></i> Pasien</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table-custom">
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
                            <td colspan="8">
                                <div class="empty-state-custom">
                                    <i class="bi bi-inbox"></i>
                                    <p>Belum ada data pasien</p>
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
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Total Pasien</p>
                <h3 class="mb-0">{{ $pasien->count() }}</h3>
            </div>
            <div class="stats-icon-custom purple">
                <i class="bi bi-grid-3x3-gap"></i>
            </div>
        </div>
    </div>
</div>
@endsection
