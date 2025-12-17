@extends('layouts.lte.main')

@section('title', 'Daftar Hewan')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Daftar Hewan</h3>
                <p class="text-muted">Kelola data hewan peliharaan Anda</p>
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
                            Hewan Peliharaan
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">

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
                                    @forelse($pet as $p)
                                        <tr>
                                            <td>{{ $p->idpet }}</td>
                                            <td>{{ $p->nama }}</td>
                                            <td>{{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d M Y') }}</td>
                                            <td>{{ $p->warna_tanda ?? '-' }}</td>
                                            <td>
                                                @if($p->jenis_kelamin == 'L')
                                                    <span class="badge bg-primary">
                                                        <i class="bi bi-gender-male"></i> Jantan
                                                    </span>
                                                @elseif($p->jenis_kelamin == 'P')
                                                    <span class="badge text-white" style="background-color:#e83e8c;">
                                                        <i class="bi bi-gender-female"></i> Betina
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">Tidak Diketahui</span>
                                                @endif
                                            </td>
                                            <td>{{ $p->ras->nama_ras ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                <i class="bi bi-inbox fs-2"></i>
                                                <p class="mt-2 mb-0">Belum ada data hewan</p>
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
