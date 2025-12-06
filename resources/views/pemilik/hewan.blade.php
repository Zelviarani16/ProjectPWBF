@extends('layouts.admin')

@section('title', 'Daftar Hewan')
@section('page-title', 'Hewan Peliharaan')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Daftar Hewan</h1>
    <p class="page-subtitle-custom">Kelola data hewan peliharaan Anda</p>
</div>

<div class="card-custom">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Warna/Tanda</th>
                        <th>Jenis Kelamin</th>
                        <th>Ras</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($hewan as $h)
                        <tr>
                            <td>{{ $h->idpet }}</td>
                            <td>{{ $h->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($h->tanggal_lahir)->format('d M Y') }}</td>
                            <td>{{ $h->warna_tanda ?? '-' }}</td>
                            <td>
                                @if($h->jenis_kelamin == 'L')
                                    <span class="badge bg-primary"><i class="bi bi-gender-male"></i> Jantan</span>
                                @elseif($h->jenis_kelamin == 'P')
                                    <span class="badge text-white" style="background-color:#e83e8c;"><i class="bi bi-gender-female"></i> Betina</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Diketahui</span>
                                @endif
                            </td>
                            <td>{{ $h->ras->nama_ras ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="empty-state-custom">
                                    <i class="bi bi-inbox fs-2"></i>
                                    <p class="mt-2 mb-2">Belum ada data hewan</p>
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
