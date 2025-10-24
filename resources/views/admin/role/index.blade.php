@extends('layouts.admin')

@section('title', 'Daftar Role')
@section('page-title', 'Role')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Daftar Role</h1>
    <p class="page-subtitle-custom">Kelola data role pengguna sistem</p>
</div>

<div class="card-custom">
    <div class="card-header-custom">
        <h5 class="card-title-custom">
            <i class="bi bi-shield-lock"></i> Data Role
        </h5>
        <a href="#" class="btn-primary-custom">
            <i class="bi bi-plus-circle"></i> Tambah Role
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Role</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roles as $role)
                        <tr>
                            <td><span class="badge-id-custom">{{ $role->idrole }}</span></td>
                            <td>{{ $role->nama_role }}</td>
                            <td>
                                <div class="action-buttons-custom">
                                    <a href="#" class="btn-warning-custom"><i class="bi bi-pencil"></i></a>
                                    <form action="#" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger-custom">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                <div class="empty-state-custom">
                                    <i class="bi bi-inbox"></i>
                                    <p>Belum ada data role</p>
                                    <a href="#" class="btn-primary-custom">
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
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Total Role</p>
                <h3 class="mb-0">{{ $roles->count() }}</h3>
            </div>
            <div class="stats-icon-custom purple">
                <i class="bi bi-grid-3x3-gap"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="stats-card-custom recent">
            <div>
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Role Terbaru</p>
                <h6 class="mb-0">{{ $roles->last()->nama_role ?? '-' }}</h6>
            </div>
            <div class="stats-icon-custom green">
                <i class="bi bi-clock-history"></i>
            </div>
        </div>
    </div>
</div>
@endsection
