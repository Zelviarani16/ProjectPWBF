@extends('layouts.lte.main')

@section('title', 'Tambah Kategori Klinis')
@section('page-title', 'Tambah Kategori Klinis')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tambah Kategori Klinis</h3>
                <p class="text-muted">Buat kategori klinis baru di sistem</p>
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
                            <i class="bi bi-plus-circle"></i> Form Tambah Kategori Klinis
                        </h3>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('admin.kategori-klinis.store') }}" method="POST">
                            @csrf

                            <!-- Nama Kategori Klinis -->
                            <div class="mb-3">
                                <label for="nama_kategori_klinis" class="form-label">
                                    Nama Kategori Klinis
                                </label>

                                <input 
                                    type="text" 
                                    name="nama_kategori_klinis" 
                                    id="nama_kategori_klinis" 
                                    class="form-control @error('nama_kategori_klinis') is-invalid @enderror"
                                    value="{{ old('nama_kategori_klinis') }}"
                                    required
                                >

                                @error('nama_kategori_klinis')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                                <small class="form-text text-muted">
                                    Masukkan nama kategori klinis yang sesuai
                                </small>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Simpan Kategori Klinis
                                </button>

                                <a href="{{ route('admin.kategori-klinis.index') }}" class="btn btn-secondary">
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
