@extends('layouts.admin')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Edit Role</h1>
        <p class="page-subtitle-custom">Ubah data role pengguna sistem</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom edit-header">
            <h5 class="card-title-custom">
                <i class="bi bi-pencil-square"></i> Form Edit Role
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.role.update', $role->idrole) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_role" class="form-label-custom">Nama Role</label>
                    <input 
                        type="text" 
                        name="nama_role" 
                        id="nama_role" 
                        class="form-control-custom @error('nama_role') is-invalid @enderror"
                        value="{{ old('nama_role', $role->nama_role) }}"
                        required
                    >
                    @error('nama_role')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Masukkan nama role yang sesuai dengan fungsi dalam sistem</small>
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-check-circle"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.role.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection