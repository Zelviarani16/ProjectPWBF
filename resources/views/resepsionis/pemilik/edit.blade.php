@extends('layouts.admin')

@section('title', 'Edit Pemilik')
@section('page-title', 'Pemilik')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Edit Pemilik</h1>
        <p class="page-subtitle-custom">Perbarui data pemilik dan kontaknya</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom edit-header">
            <h5 class="card-title-custom">
                <i class="bi bi-pencil-square"></i> Form Edit Pemilik
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('resepsionis.pemilik.update', $pemilik->idpemilik) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')

                {{-- Nama Pemilik --}}
                <div class="form-group">
                    <label for="nama_pemilik" class="form-label-custom">Nama Pemilik</label>
                    <input
                        type="text"
                        name="nama_pemilik"
                        id="nama_pemilik"
                        class="form-control-custom @error('nama_pemilik') is-invalid @enderror"
                        value="{{ old('nama_pemilik', $pemilik->nama_pemilik) }}"
                        required
                    >
                    @error('nama_pemilik')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="form-group">
                    <label for="alamat" class="form-label-custom">Alamat</label>
                    <input
                        type="text"
                        name="alamat"
                        id="alamat"
                        class="form-control-custom @error('alamat') is-invalid @enderror"
                        value="{{ old('alamat', $pemilik->alamat) }}"
                        required
                    >
                    @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- No WhatsApp --}}
                <div class="form-group">
                    <label for="no_wa" class="form-label-custom">No WhatsApp</label>
                    <input
                        type="text"
                        name="no_wa"
                        id="no_wa"
                        class="form-control-custom @error('no_wa') is-invalid @enderror"
                        value="{{ old('no_wa', $pemilik->no_wa) }}"
                        required
                    >
                    @error('no_wa')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('resepsionis.pemilik.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
