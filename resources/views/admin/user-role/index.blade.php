@extends('layouts.lte.main')

@section('title', 'Manajemen User Role')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Manajemen User Role</h3>
                <p class="text-muted">Kelola role yang dimiliki oleh setiap user dalam sistem</p>
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
                            <a href="{{ route('admin.user-role.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle"></i> Tambah
                            </a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th style="width:70px;">No</th>
                                        <th style="width:140px;">ID Role User</th>
                                        <th>User</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th style="width:150px;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($users as $index => $user)

                                        @forelse($user->roles as $role)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $role->pivot->idrole_user }}</td>
                                            <td>{{ $user->nama }}</td>
                                            <td>{{ $role->nama_role }}</td>
                                            <td>
                                                @if($role->pivot->status == 1)
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">

                                                    <!-- Edit -->
                                                    <a href="{{ route('admin.user-role.edit', ['iduser' => $user->iduser, 'idrole' => $role->idrole]) }}"
                                                       class="btn btn-warning btn-sm">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>

                                                    <!-- Delete -->
                                                    <form action="{{ route('admin.user-role.destroy', ['iduser' => $user->iduser, 'idrole' => $role->idrole]) }}"
                                                          method="POST"
                                                          onsubmit="return confirm('Yakin ingin menghapus role ini dari user: {{ $user->nama }}?');">
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
                                            <td>{{ $index + 1 }}</td>
                                            <td colspan="5" class="text-center text-muted">
                                                Belum ada role untuk user ini
                                            </td>
                                        </tr>
                                        @endforelse

                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-4"></i>
                                            <p class="mb-2">Belum ada data user role</p>
                                            <a href="{{ route('admin.user-role.create') }}" class="btn btn-primary btn-sm">
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
                        <span class="info-box-text">Total User</span>
                        <span class="info-box-number">{{ $users->count() }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="info-box bg-success">
                    <span class="info-box-icon">
                        <i class="bi bi-clock-history"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">User Terbaru</span>
                        <span class="info-box-number">{{ $users->last()->nama ?? '-' }}</span>
                    </div>
                </div>
            </div>

        </div>
        <!-- /Stats Cards -->

    </div>
</div>

@endsection
