@extends('layouts.admin')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Tambah User</h1>
        <p class="page-subtitle-custom">Buat akun pengguna baru untuk sistem</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom create-header">
            <h5 class="card-title-custom">
                <i class="bi bi-person-plus"></i> Form Tambah User
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.user.store') }}" method="POST" autocomplete="off">
        @csrf
                <div class="form-group">
                    <label for="nama" class="form-label-custom">Nama Lengkap</label>
                    <input 
                        type="text" 
                        name="nama" 
                        id="nama" 
                        class="form-control-custom @error('nama') is-invalid @enderror"
                        required
                    >
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label-custom">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="form-control-custom @error('email') is-invalid @enderror"
                        autocomplete="off"
                        required
                    >

                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label-custom">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="form-control-custom @error('password') is-invalid @enderror"
                        autocomplete="new-password"
                        required
                    >

                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="retype_password" class="form-label-custom">Ulangi Password</label>
                    <input 
                        type="password" 
                        name="retype_password" 
                        id="retype_password" 
                        class="form-control-custom @error('retype_password') is-invalid @enderror"
                        required
                    >
                    @error('retype_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-save"></i> Simpan User
                    </button>
                    <a href="{{ route('admin.user.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
