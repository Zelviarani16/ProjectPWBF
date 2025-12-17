@extends('layouts.lte.main')

@section('title', 'Data Pemilik')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Data Pemilik</h3>
                <p class="text-muted">Kelola semua data pemilik hewan</p>
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
                        <div class="card-tools">
                            <a href="{{ route('resepsionis.pemilik.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle"></i> Tambah
                            </a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width:70px;">ID</th>
                                        <th>Nama User</th>
                                        <th>Email</th>
                                        <th>No WhatsApp</th>
                                        <th>Alamat</th>
                                        <th style="width:150px;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($pemilik as $p)
                                    <tr>
                                        <td>{{ $p->idpemilik }}</td>
                                        <td>{{ $p->user->nama ?? '-' }}</td>
                                        <td>{{ $p->user->email ?? '-' }}</td>
                                        <td>{{ $p->no_wa ?? '-' }}</td>
                                        <td>{{ $p->alamat ?? '-' }}</td>

                                        <td>
                                            <div class="btn-group">

                                                <!-- Edit -->
                                                <a href="{{ route('resepsionis.pemilik.edit', $p->idpemilik) }}"
                                                   class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <!-- Delete -->
                                                <form action="{{ route('resepsionis.pemilik.destroy', $p->idpemilik) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin menghapus pemilik ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>

                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-4"></i>
                                            <p class="mb-2">Belum ada data pemilik</p>
                                            <a href="{{ route('resepsionis.pemilik.create') }}" class="btn btn-primary btn-sm">
                                                <i class="bi bi-plus-circle"></i> Tambah Data
                                            </a>
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
                    <span class="info-box-icon">
                        <i class="bi bi-people"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pemilik</span>
                        <span class="info-box-number">{{ $pemilik->count() }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="info-box bg-success">
                    <span class="info-box-icon">
                        <i class="bi bi-clock-history"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pemilik Terbaru</span>
                        <span class="info-box-number">
                            {{ $pemilik->last()->user->nama ?? '-' }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Stats Cards -->

    </div>
</div>
<!-- /App Content -->

@endsection
