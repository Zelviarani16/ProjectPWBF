@extends('layouts.admin')

@section('title', 'Edit Role User')

@section('content')
<div class="container">
    <h1>Edit Role User</h1>

    <div class="card p-3">
        <form action="{{ route('admin.user-role.update', [$user->iduser, $role->idrole]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>User</label>
                <input type="text" class="form-control" value="{{ $user->nama }}" disabled>
            </div>

            <div class="form-group mb-3">
                <label>Role</label>
                <input type="text" class="form-control" value="{{ $role->nama_role }}" disabled>
            </div>

            <div class="form-group mb-3">
                <label>Status Role</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $role->pivot->status == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $role->pivot->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="{{ route('admin.user-role.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
