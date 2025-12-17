@extends('layouts.lte.main')

@section('title', 'Daftar User')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Daftar User</h3>
                <p class="text-muted">Kelola data user beserta rolenya</p>
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
                            <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle"></i> Tambah
                            </a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th style="width:80px;">ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th style="width:150px;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->iduser }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @forelse($user->roles as $role)
                                                {{ $role->nama_role }}@if(!$loop->last), @endif
                                            @empty
                                                <span class="text-muted">Tidak ada role</span>
                                            @endforelse
                                        </td>
                                        <td>
                                            <div class="btn-group">

                                                <!-- Edit -->
                                                <a href="{{ route('admin.user.edit', $user->iduser) }}"
                                                   class="btn btn-warning btn-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <!-- Delete -->
                                                <form action="{{ route('admin.user.destroy', $user->iduser) }}"
                                                      method="POST">
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
                                        <td colspan="5" class="text-center text-muted py-4">
                                            <i class="bi bi-inbox fs-4"></i>
                                            <p class="mb-2">Belum ada data user</p>
                                            <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn-sm">
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
                        <i class="bi bi-person-lines-fill"></i>
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
