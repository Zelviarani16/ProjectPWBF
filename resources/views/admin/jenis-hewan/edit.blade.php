@extends('layouts.admin')

@section('title', 'Edit Jenis Hewan')
@section('page-title', 'Edit Jenis Hewan')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Edit Jenis Hewan</h1>
        <p class="page-subtitle-custom">Perbarui informasi jenis hewan di sistem</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom edit-header">
            <h5 class="card-title-custom">
                <i class="bi bi-pencil-square"></i> Form Edit Jenis Hewan
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.jenis-hewan.update', $jenisHewan->idjenis_hewan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_jenis_hewan" class="form-label-custom">Nama Jenis Hewan</label>
                    <input 
                        type="text" 
                        name="nama_jenis_hewan" 
                        id="nama_jenis_hewan" 
                        class="form-control-custom @error('nama_jenis_hewan') is-invalid @enderror"
                        value="{{ old('nama_jenis_hewan', $jenisHewan->nama_jenis_hewan) }}"
                        required
                    >
                    @error('nama_jenis_hewan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-check-circle"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.jenis-hewan.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
