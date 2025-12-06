d@extends('layouts.admin')

@section('title', 'Rekam Medis')
@section('page-title', 'Rekam Medis Hewan')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Rekam Medis</h1>
    <p class="page-subtitle-custom">Lihat rekam medis hewan peliharaan Anda</p>
</div>

<div class="card-custom">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Diagnosa</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekamMedis as $rm)
                        <tr>
                            <td>{{ $rm->idrekam_medis }}</td>
                            <td>{{ $rm->diagnosa }}</td>
                            <td>
                                <a href="{{ route('pemilik.detail-rekam-medis', $rm->idrekam_medis) }}" class="btn-primary-custom">Lihat Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4">
                                <div class="empty-state-custom">
                                    <i class="bi bi-inbox fs-2"></i>
                                    <p class="mt-2 mb-2">Belum ada rekam medis</p>
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
