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
@endsection
