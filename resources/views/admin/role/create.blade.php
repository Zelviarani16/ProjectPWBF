@extends('layouts.admin')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Tambah Role</h1>
        <p class="page-subtitle-custom">Buat role baru untuk pengguna sistem</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom create-header">
            <h5 class="card-title-custom">
                <i class="bi bi-plus-circle"></i> Form Tambah Role
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.role.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="nama_role" class="form-label-custom">Nama Role</label>
                    <input 
                        type="text" 
                        name="nama_role" 
                        id="nama_role" 
                        class="form-control-custom @error('nama_role') is-invalid @enderror"
                        value="{{ old('nama_role') }}"
                        required
                    >
                    @error('nama_role')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Masukkan nama role yang sesuai dengan fungsi dalam sistem</small>
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-save"></i> Simpan Role
                    </button>
                    <a href="{{ route('admin.role.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection