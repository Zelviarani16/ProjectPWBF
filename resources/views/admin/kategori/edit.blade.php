@extends('layouts.lte.main')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <!-- Page Header -->
            <div class="mb-3 pt-4">
                <h1 class="h3 mb-0 text-gray-800">Edit Kategori</h1>
                <p class="text-muted">Ubah data kategori sistem</p>
            </div>

            <!-- Card Form -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-pencil-square"></i> Form Edit Kategori
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.kategori.update', $kategori->idkategori) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input 
                                type="text" 
                                name="nama_kategori" 
                                id="nama_kategori" 
                                class="form-control @error('nama_kategori') is-invalid @enderror"
                                value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                                required
                            >
                            @error('nama_kategori')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
