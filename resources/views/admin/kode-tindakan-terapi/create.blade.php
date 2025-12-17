@extends('layouts.lte.main')

@section('title', 'Tambah Kode Tindakan Terapi')
@section('page-title', 'Tambah Kode Tindakan Terapi')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tambah Kode Tindakan Terapi</h3>
                <p class="text-muted">Buat kode tindakan terapi baru</p>
            </div>
        </div>
    </div>
</div>
<!-- /App Content Header -->

<!-- App Content -->
<div class="app-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <!-- Card Form -->
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-plus-circle"></i> Form Tambah Kode
                        </h3>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('admin.kode-tindakan-terapi.store') }}" method="POST">
                            @csrf

                            <!-- Kode -->
                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode</label>
                                <input 
                                    type="text" 
                                    name="kode" 
                                    id="kode" 
                                    class="form-control @error('kode') is-invalid @enderror"
                                    value="{{ old('kode') }}" 
                                    required
                                >
                                @error('kode') 
                                    <small class="text-danger">{{ $message }}</small> 
                                @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label for="deskripsi_tindakan_terapi" class="form-label">Deskripsi</label>
                                <textarea 
                                    name="deskripsi_tindakan_terapi" 
                                    id="deskripsi_tindakan_terapi" 
                                    class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror"
                                    required
                                >{{ old('deskripsi_tindakan_terapi') }}</textarea>
                                @error('deskripsi_tindakan_terapi') 
                                    <small class="text-danger">{{ $message }}</small> 
                                @enderror
                            </div>

                            <!-- Kategori -->
                            <div class="mb-3">
                                <label for="idkategori" class="form-label">Kategori</label>
                                <select 
                                    name="idkategori" 
                                    id="idkategori" 
                                    class="form-select"
                                    required
                                >
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategori as $k)
                                        <option value="{{ $k->idkategori }}" 
                                            {{ old('idkategori') == $k->idkategori ? 'selected' : '' }}>
                                            {{ $k->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Kategori Klinis -->
                            <div class="mb-4">
                                <label for="idkategori_klinis" class="form-label">Kategori Klinis</label>
                                <select 
                                    name="idkategori_klinis" 
                                    id="idkategori_klinis" 
                                    class="form-select"
                                    required
                                >
                                    <option value="">-- Pilih Kategori Klinis --</option>
                                    @foreach($kategoriKlinis as $kk)
                                        <option value="{{ $kk->idkategori_klinis }}" 
                                            {{ old('idkategori_klinis') == $kk->idkategori_klinis ? 'selected' : '' }}>
                                            {{ $kk->nama_kategori_klinis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Simpan
                                </button>

                                <a href="{{ route('admin.kode-tindakan-terapi.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                            </div>

                        </form>

                    </div>

                </div>
                <!-- /Card -->

            </div>
        </div>

    </div>
</div>
<!-- /App Content -->

@endsection
