@extends('layouts.admin')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Edit Kode Tindakan Terapi</h1>
        <p class="page-subtitle-custom">Ubah data kode tindakan terapi</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom edit-header">
            <h5 class="card-title-custom"><i class="bi bi-pencil-square"></i> Form Edit Kode</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.kode-tindakan-terapi.update', $kodeTindakanTerapi->idkode_tindakan_terapi) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="kode" class="form-label-custom">Kode</label>
                    <input type="text" name="kode" id="kode" class="form-control-custom @error('kode') is-invalid @enderror"
                           value="{{ old('kode', $kodeTindakanTerapi->kode) }}" required>
                    @error('kode') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="deskripsi_tindakan_terapi" class="form-label-custom">Deskripsi</label>
                    <textarea name="deskripsi_tindakan_terapi" id="deskripsi_tindakan_terapi" class="form-control-custom @error('deskripsi_tindakan_terapi') is-invalid @enderror" required>{{ old('deskripsi_tindakan_terapi', $kodeTindakanTerapi->deskripsi_tindakan_terapi) }}</textarea>
                    @error('deskripsi_tindakan_terapi') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="idkategori" class="form-label-custom">Kategori</label>
                    <select name="idkategori" id="idkategori" class="form-control-custom" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k) 
                            <option value="{{ $k->idkategori }}" {{ old('idkategori', $kodeTindakanTerapi->idkategori) == $k->idkategori ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="idkategori_klinis" class="form-label-custom">Kategori Klinis</label>
                    <select name="idkategori_klinis" id="idkategori_klinis" class="form-control-custom" required>
                        <option value="">-- Pilih Kategori Klinis --</option>
                        @foreach($kategoriKlinis as $kk) 
                            <option value="{{ $kk->idkategori_klinis }}" {{ old('idkategori_klinis', $kodeTindakanTerapi->idkategori_klinis) == $kk->idkategori_klinis ? 'selected' : '' }}>
                                {{ $kk->nama_kategori_klinis }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom"><i class="bi bi-check-circle"></i> Simpan Perubahan</button>
                    <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn-secondary-custom"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
