@extends('layouts.admin')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Tambah Kategori</h1>
        <p class="page-subtitle-custom">Buat kategori baru di sistem</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom create-header">
            <h5 class="card-title-custom"><i class="bi bi-plus-circle"></i> Form Tambah Kategori</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama_kategori" class="form-label-custom">Nama Kategori</label>
                    <input 
                        type="text" 
                        name="nama_kategori" 
                        id="nama_kategori" 
                        class="form-control-custom @error('nama_kategori') is-invalid @enderror"
                        value="{{ old('nama_kategori') }}"
                        required
                    >
                    @error('nama_kategori')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Masukkan nama kategori yang sesuai</small>
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-save"></i> Simpan Kategori
                    </button>
                    <a href="{{ route('admin.kategori.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
