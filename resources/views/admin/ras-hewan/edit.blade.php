@extends('layouts.admin')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Edit Ras Hewan</h1>
        <p class="page-subtitle-custom">Ubah data ras hewan sistem</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom edit-header">
            <h5 class="card-title-custom">
                <i class="bi bi-pencil-square"></i> Form Edit Ras Hewan
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.ras-hewan.update', $rasHewan->idras_hewan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama_ras" class="form-label-custom">Nama Ras</label>
                    <input 
                        type="text" 
                        name="nama_ras" 
                        id="nama_ras" 
                        class="form-control-custom @error('nama_ras') is-invalid @enderror"
                        value="{{ old('nama_ras', $rasHewan->nama_ras) }}"
                        required
                    >
                    @error('nama_ras')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Masukkan nama ras hewan sesuai dengan jenis hewan</small>
                </div>

                <div class="form-group">
                    <label for="idjenis_hewan" class="form-label-custom">Jenis Hewan</label>
                    <select 
                        name="idjenis_hewan" 
                        id="idjenis_hewan" 
                        class="form-select-custom @error('idjenis_hewan') is-invalid @enderror"
                        required
                    >
                        <option value="">-- Pilih Jenis Hewan --</option>
                        @foreach($jenisHewan as $jenis)
                            <option value="{{ $jenis->idjenis_hewan }}" 
                                {{ old('idjenis_hewan', $rasHewan->idjenis_hewan) == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                {{ $jenis->nama_jenis_hewan }}
                            </option>
                        @endforeach
                    </select>
                    @error('idjenis_hewan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-check-circle"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.ras-hewan.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
