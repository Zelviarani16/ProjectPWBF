@extends('layouts.lte.main')

@section('title', 'Tambah Jenis Hewan')
@section('page-title', 'Tambah Jenis Hewan')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tambah Jenis Hewan</h3>
                <p class="text-muted">Tambah jenis hewan baru ke dalam sistem</p>
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
                            <i class="bi bi-plus-circle"></i> Form Tambah Jenis Hewan
                        </h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.jenis-hewan.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="nama_jenis_hewan" class="form-label">
                                    Nama Jenis Hewan
                                </label>

                                <input
                                    type="text"
                                    name="nama_jenis_hewan"
                                    id="nama_jenis_hewan"
                                    class="form-control @error('nama_jenis_hewan') is-invalid @enderror"
                                    value="{{ old('nama_jenis_hewan') }}"
                                    required
                                >

                                @error('nama_jenis_hewan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <small class="form-text text-muted">
                                    Masukkan nama jenis hewan
                                </small>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Simpan
                                </button>

                                <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary">
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
