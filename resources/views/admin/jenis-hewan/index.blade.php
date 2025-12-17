@extends('layouts.lte.main')

@section('title', 'Jenis Hewan')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Daftar Jenis Hewan</h3>
                <p class="text-muted">Kelola data jenis hewan yang tersedia di klinik</p>
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

                    <div class="card-header"  >
                        <!-- <h3 class="card-title">Tabel Data Jenis Hewan</h3> -->

                        <div class="card-tools">
                            <a href="{{ route('admin.jenis-hewan.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle"></i> Tambah
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 80px;">ID</th>
                                    <th>Nama Jenis Hewan</th>
                                    <th style="width: 160px;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($jenisHewan as $index => $jenis)
                                <tr>
                                    <td>{{ $jenis->idjenis_hewan }}</td>
                                    <td>{{ $jenis->nama_jenis_hewan }}</td>

                                    <td>
                                        <div class="btn-group">

                                            <!-- Edit -->
                                            <a href="{{ route('admin.jenis-hewan.edit', $jenis->idjenis_hewan) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.jenis-hewan.destroy', $jenis->idjenis_hewan) }}"
                                                style="display:inline;" method="POST"
                                                onsubmit="return confirm('Hapus jenis hewan {{ $jenis->nama_jenis_hewan }}?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                @if($jenisHewan->count() == 0)
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        <i class="bi bi-inbox"></i>
                                        <p>Belum ada data jenis hewan.</p>
                                    </td>
                                </tr>
                                @endif
                            </tbody>

                        </table>
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
                        <span class="info-box-text">Total Jenis Hewan</span>
                        <span class="info-box-number">{{ $jenisHewan->count() }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="bi bi-clock-history"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Jenis Hewan Terbaru</span>
                        <span class="info-box-number">{{ $jenisHewanTerbaru->nama_jenis_hewan ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

    
    </div>
</div>

        <!-- Stats Cards -->


<!-- /App Content -->

@endsection
