@extends('layouts.lte.main')

@section('title', 'Edit Kode Tindakan Terapi')
@section('page-title', 'Edit Kode Tindakan Terapi')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="mb-3 pt-4">
                <h1 class="h3 mb-0 text-gray-800">Edit Kode Tindakan Terapi</h1>
                <p class="text-muted">Ubah data kode tindakan terapi</p>
            </div>

            <!-- Card Form -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-pencil-square"></i> Form Edit Kode
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.kode-tindakan-terapi.update', $kodeTindakanTerapi->idkode_tindakan_terapi) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode</label>
                            <input 
                                type="text" 
                                name="kode" 
                                id="kode" 
                                class="form-control @error('kode') is-invalid @enderror"
                                value="{{ old('kode', $kodeTindakanTerapi->kode) }}" 
                                required
                            >
                            @error('kode')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_tindakan_terapi" class="form-label">Deskripsi</label>
                            <textarea 
                                name="deskripsi_tindakan_terapi" 
                                id="deskripsi_tindakan_terapi" 
                                class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror" 
                                required
                            >{{ old('deskripsi_tindakan_terapi', $kodeTindakanTerapi->deskripsi_tindakan_terapi) }}</textarea>
                            @error('deskripsi_tindakan_terapi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="idkategori" class="form-label">Kategori</label>
                            <select 
                                name="idkategori" 
                                id="idkategori" 
                                class="form-control"
                                required
                            >
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->idkategori }}"
                                        {{ old('idkategori', $kodeTindakanTerapi->idkategori) == $k->idkategori ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="idkategori_klinis" class="form-label">Kategori Klinis</label>
                            <select 
                                name="idkategori_klinis" 
                                id="idkategori_klinis" 
                                class="form-control"
                                required
                            >
                                <option value="">-- Pilih Kategori Klinis --</option>
                                @foreach($kategoriKlinis as $kk)
                                    <option value="{{ $kk->idkategori_klinis }}"
                                        {{ old('idkategori_klinis', $kodeTindakanTerapi->idkategori_klinis) == $kk->idkategori_klinis ? 'selected' : '' }}>
                                        {{ $kk->nama_kategori_klinis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
