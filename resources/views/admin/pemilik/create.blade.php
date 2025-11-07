@extends('layouts.admin')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Tambah Data Pemilik</h1>
        <p class="page-subtitle-custom">Masukkan informasi lengkap pemilik hewan</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom create-header">
            <h5 class="card-title-custom">
                <i class="bi bi-plus-circle"></i> Form Tambah Pemilik
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.pemilik.store') }}" method="POST">
                @csrf

                {{-- Nama Pemilik --}}
                <div class="form-group">
                    <label for="nama_pemilik" class="form-label-custom">Nama Pemilik</label>
                    <input 
                        type="text" 
                        name="nama_pemilik" 
                        id="nama_pemilik" 
                        class="form-control-custom @error('nama_pemilik') is-invalid @enderror"
                        value="{{ old('nama_pemilik') }}" 
                        required
                    >
                    @error('nama_pemilik')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Masukkan nama lengkap pemilik hewan</small>
                </div>

                {{-- Alamat --}}
                <div class="form-group">
                    <label for="alamat" class="form-label-custom">Alamat</label>
                    <textarea 
                        name="alamat" 
                        id="alamat" 
                        class="form-control-custom @error('alamat') is-invalid @enderror" 
                        rows="3"
                        required
                    >{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Tuliskan alamat lengkap pemilik</small>
                </div>

                {{-- Nomor Telepon --}}
                <div class="form-group">
                    <label for="no_wa" class="form-label-custom">Nomor Telepon</label>
                    <input 
                        type="text" 
                        name="no_wa" 
                        id="no_wa" 
                        class="form-control-custom @error('no_wa') is-invalid @enderror"
                        value="{{ old('no_wa') }}" 
                        required
                    >
                    @error('no_telp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Masukkan nomor telepon aktif (contoh: 08123456789)</small>
                </div>

                {{-- Tombol Aksi --}}
                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.pemilik.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
