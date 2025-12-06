@extends('layouts.admin')
@section('title', 'Tambah Role ke User')

@section('content')
<h2>Tambah Role ke User</h2>

<form action="{{ route('admin.user-role.store') }}" method="POST">
    @csrf
    <label>User:</label>
    <select name="iduser" required>
        <option value="">-- Pilih User --</option>
        @foreach($users as $u)
            <option value="{{ $u->iduser }}">{{ $u->nama }} ({{ $u->email }})</option>
        @endforeach
    </select>

    <label>Role:</label>
    <select name="idrole" required>
        <option value="">-- Pilih Role --</option>
        @foreach($roles as $r)
            <option value="{{ $r->idrole }}">{{ $r->nama_role }}</option>
        @endforeach
    </select>

    <label>Status:</label>
    <select name="status">
        <option value="1">Aktif</option>
        <option value="0">Nonaktif</option>
    </select>

    <button type="submit" class="btn btn-success">💾 Simpan Role</button>
    <a href="{{ route('admin.user-role.index') }}" class="btn btn-secondary">⬅ Kembali</a>
</form>
@endsection
