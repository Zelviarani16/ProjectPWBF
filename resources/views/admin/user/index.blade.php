@extends('layouts.admin')

@section('title', 'Daftar User')
@section('page-title', 'User dan Role')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Daftar User</h1>
    <p class="page-subtitle-custom">Kelola data user beserta rolenya</p>
</div>

<div class="card-custom">
    <div class="card-header-custom">
        <h5 class="card-title-custom">
            <i class="bi bi-shield-lock"></i> Data User
        </h5>
        <a href="{{ route('admin.user.create') }}" class="btn-primary-custom">
            <i class="bi bi-plus-circle"></i> Tambah User
        </a>
    </div>


    <div class="card-body">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td><span class="badge-id-custom">{{ $user->iduser }}</span></td>
                            <td>{{ $user->nama }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @forelse($user->roles as $role)
                                    {{ $role->nama_role }}@if(!$loop->last), @endif
                                @empty
                                    <span>Tidak ada role</span>
                                @endforelse
                            </td>
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
                            <td colspan="5">
                                <div class="empty-state-custom">
                                    <i class="bi bi-inbox"></i>
                                    <p>Belum ada data user</p>
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

{{-- Statistik --}}
<div class="row mt-4">
    <div class="col-md-6 mb-3">
        <div class="stats-card-custom">
            <div>
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">Total User</p>
                <h3 class="mb-0">{{ $users->count() }}</h3>
            </div>
            <div class="stats-icon-custom purple">
                <i class="bi bi-person-lines-fill"></i>
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="stats-card-custom recent">
            <div>
                <p class="text-muted mb-1" style="font-size:13px;font-weight:600;">User Terbaru</p>
                <h6 class="mb-0">{{ $users->last()->nama ?? '-' }}</h6>
            </div>
            <div class="stats-icon-custom green">
                <i class="bi bi-clock-history"></i>
            </div>
        </div>
    </div>
</div>
@endsection
