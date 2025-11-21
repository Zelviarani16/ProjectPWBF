@extends('layouts.admin')

@section('title', 'Edit Kategori')


@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Edit Kategori</h1>
        <p class="page-subtitle-custom">Ubah data kategori sistem</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom edit-header">
            <h5 class="card-title-custom"><i class="bi bi-pencil-square"></i> Form Edit Kategori</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.kategori.update', $kategori->idkategori) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_kategori" class="form-label-custom">Nama Kategori</label>
                    <input 
                        type="text" 
                        name="nama_kategori" 
                        id="nama_kategori" 
                        class="form-control-custom @error('nama_kategori') is-invalid @enderror"
                        value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                        required
                    >
                    @error('nama_kategori')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-check-circle"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.kategori.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
