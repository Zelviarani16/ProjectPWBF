@extends('layouts.lte.main')
@section('title', 'Edit Profil Pemilik')

@section('content')

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Edit Profil Pemilik</h2>
        <a href="{{ route('pemilik.profil.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <strong>Terdapat kesalahan:</strong>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

<form action="{{ route('pemilik.profil.update') }}" method="POST">
@csrf

<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Informasi Akun</h5>
    </div>
    <div class="card-body">
        <input type="text" name="nama" class="form-control mb-3"
               value="{{ old('nama', $user->nama) }}" required>

        <input type="email" class="form-control mb-3"
               value="{{ $user->email }}" disabled>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">Informasi Pemilik</h5>
    </div>
    <div class="card-body">

        <textarea name="alamat" class="form-control mb-3" required>{{ old('alamat', $pemilik->alamat) }}</textarea>

        <input type="text" name="no_wa" class="form-control mb-3"
               value="{{ old('no_wa', $pemilik->no_wa) }}" required>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('pemilik.profil.index') }}" class="btn btn-secondary">Batal</a>
        </div>

    </div>
</div>
</form>

</div>

@endsection