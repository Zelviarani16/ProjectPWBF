@extends('layouts.admin')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Tambah Kategori Klinis</h1>
        <p class="page-subtitle-custom">Buat kategori klinis baru di sistem</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom create-header">
            <h5 class="card-title-custom"><i class="bi bi-plus-circle"></i> Form Tambah Kategori Klinis</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.kategori-klinis.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama_kategori_klinis" class="form-label-custom">Nama Kategori Klinis</label>
                    <input 
                        type="text" 
                        name="nama_kategori_klinis" 
                        id="nama_kategori_klinis" 
                        class="form-control-custom @error('nama_kategori_klinis') is-invalid @enderror"
                        value="{{ old('nama_kategori_klinis') }}"
                        required
                    >
                    @error('nama_kategori_klinis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Masukkan nama kategori klinis yang sesuai</small>
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-save"></i> Simpan Kategori Klinis
                    </button>
                    <a href="{{ route('admin.kategori-klinis.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
