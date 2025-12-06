@extends('layouts.admin')

@section('title', 'Data Pemilik')
@section('page-title', 'Pemilik')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Data Pemilik</h1>
    <p class="page-subtitle-custom">Kelola semua data pemilik hewan</p>
</div>

<div class="card-custom">
    <div class="card-header-custom">
        <h5 class="card-title-custom"><i class="bi bi-people"></i> Pemilik</h5>
        <a href="{{ route('admin.pemilik.create') }}" class="btn-primary-custom">
            <i class="bi bi-plus-circle"></i> Tambah Pemilik
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama User</th>
                        <th>Email</th>
                        <th>No WA</th>
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
                            <td>{{ $p->no_wa }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>
                                <div class="action-buttons-custom">
                                    <a href="{{ route('admin.pemilik.edit', $p->idpemilik) }}" class="btn-warning-custom"><i class="bi bi-pencil"></i></a>
                                    <form action="{{ route('admin.pemilik.destroy', $p->idpemilik) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger-custom" onclick="return confirm('Yakin ingin menghapus pemilik ini?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state-custom">
                                    <i class="bi bi-inbox"></i>
                                    <p>Belum ada data pemilik</p>
                                    <a href="{{ route('admin.pemilik.create') }}" class="btn-primary-custom">
                                        <i class="bi bi-plus-circle"></i> Tambah Data
                                    </a>
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
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Total Pemilik</p>
                <h3 class="mb-0">{{ $pemilik->count() }}</h3>
            </div>
            <div class="stats-icon-custom purple">
                <i class="bi bi-grid-3x3-gap"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="stats-card-custom recent">
            <div>
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Pemilik Terbaru</p>
                <h6 class="mb-0">{{ $pemilikTerbaru->user->nama ?? '-' }}</h6>
            </div>
            <div class="stats-icon-custom green">
                <i class="bi bi-clock-history"></i>
            </div>
        </div>
    </div>
</div>
@endsection
