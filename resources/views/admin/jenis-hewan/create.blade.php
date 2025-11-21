@extends('layouts.admin')

@section('title', 'Tambah Jenis Hewan')
@section('page-title', 'Tambah Jenis Hewan')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Tambah Jenis Hewan</h1>
        <p class="page-subtitle-custom">Tambah jenis hewan baru ke dalam sistem</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom create-header">
            <h5 class="card-title-custom">
                <i class="bi bi-plus-circle"></i> Form Tambah Jenis Hewan
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.jenis-hewan.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama_jenis_hewan" class="form-label-custom">Nama Jenis Hewan</label>
                    <input 
                        type="text" 
                        name="nama_jenis_hewan" 
                        id="nama_jenis_hewan" 
                        class="form-control-custom @error('nama_jenis_hewan') is-invalid @enderror"
                        value="{{ old('nama_jenis_hewan') }}"
                        required
                    >
                    @error('nama_jenis_hewan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Masukkan nama jenis hewan</small>
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.jenis-hewan.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
