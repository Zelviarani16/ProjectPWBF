@extends('layouts.admin')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Edit User</h1>
        <p class="page-subtitle-custom">Perbarui data akun pengguna sistem</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom edit-header">
            <h5 class="card-title-custom">
                <i class="bi bi-pencil-square"></i> Form Edit User
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.user.update', $user->iduser) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="form-group">
                    <label for="nama" class="form-label-custom">Nama Lengkap</label>
                    <input 
                        type="text" 
                        name="nama" 
                        id="nama" 
                        class="form-control-custom @error('nama') is-invalid @enderror"
                        value="{{ old('nama', $user->nama) }}"
                        required
                    >
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email" class="form-label-custom">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="form-control-custom @error('email') is-invalid @enderror"
                        value="{{ old('email', $user->email) }}"
                        required
                    >
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Password (opsional) --}}
                <div class="form-group">
                    <label for="password" class="form-label-custom">Password (Opsional)</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="form-control-custom @error('password') is-invalid @enderror"
                        autocomplete="new-password"
                        placeholder="Biarkan kosong jika tidak ingin mengubah"
                    >
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Retype Password --}}
                <div class="form-group">
                    <label for="retype_password" class="form-label-custom">Ulangi Password (Opsional)</label>
                    <input 
                        type="password" 
                        name="retype_password" 
                        id="retype_password" 
                        class="form-control-custom @error('retype_password') is-invalid @enderror"
                        placeholder="Biarkan kosong jika tidak mengubah password"
                    >
                    @error('retype_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-save"></i> Simpan Perubahan
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
