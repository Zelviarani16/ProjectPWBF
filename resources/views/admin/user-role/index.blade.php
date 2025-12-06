@extends('layouts.admin')

@section('title', 'Manajemen User Role')

@section('content')
<div class="container">
    <h1>Manajemen User Role</h1>

    <a href="{{ route('admin.user-role.create') }}" class="btn btn-primary mb-3">Tambah User Role</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>User</th>
                <th>Role</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
                @forelse($user->roles as $role)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $role->nama_role }}</td>
                    <td>{{ $role->pivot->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                    <td>
                        <a href="{{ route('admin.user-role.edit', ['iduser' => $user->iduser, 'idrole' => $role->idrole]) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.user-role.destroy', ['iduser' => $user->iduser, 'idrole' => $role->idrole]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus role ini dari user?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->nama }}</td>
                    <td colspan="3" class="text-center">Belum ada role</td>
                </tr>
                @endforelse
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
