@extends('layouts.lte.main')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tambah User</h3>
                <p class="text-muted">Buat akun pengguna baru untuk sistem</p>
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

                <!-- Card -->
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-person-plus"></i> Form Tambah User
                        </h3>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('admin.user.store') }}" method="POST" autocomplete="off">
                            @csrf

                            {{-- Nama Lengkap --}}
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input 
                                    type="text" 
                                    name="nama" 
                                    id="nama" 
                                    class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama') }}"
                                    required
                                >
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input 
                                    type="email" 
                                    name="email" 
                                    id="email" 
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}"
                                    autocomplete="off"
                                    required
                                >
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    class="form-control @error('password') is-invalid @enderror"
                                    autocomplete="new-password"
                                    required
                                >
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Retype Password --}}
                            <div class="mb-4">
                                <label for="retype_password" class="form-label">Ulangi Password</label>
                                <input 
                                    type="password" 
                                    name="retype_password" 
                                    id="retype_password" 
                                    class="form-control @error('retype_password') is-invalid @enderror"
                                    required
                                >
                                @error('retype_password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Buttons --}}
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Simpan User
                                </button>

                                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                            </div>

                        </form>

                    </div>
                </div>
                <!-- /Card -->

            </div>
        </div>

    </div>
</div>
<!-- /App Content -->

@endsection
