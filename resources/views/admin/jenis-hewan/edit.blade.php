@extends('layouts.lte.main')

@section('title', 'Edit Jenis Hewan')
@section('page-title', 'Edit Jenis Hewan')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Edit Jenis Hewan</h3>
                <p class="text-muted">Perbarui informasi jenis hewan di sistem</p>
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
                            <i class="bi bi-pencil-square"></i> Form Edit Jenis Hewan
                        </h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.jenis-hewan.update', $jenisHewan->idjenis_hewan) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama_jenis_hewan" class="form-label">
                                    Nama Jenis Hewan
                                </label>

                                <input 
                                    type="text" 
                                    name="nama_jenis_hewan" 
                                    id="nama_jenis_hewan" 
                                    class="form-control @error('nama_jenis_hewan') is-invalid @enderror"
                                    value="{{ old('nama_jenis_hewan', $jenisHewan->nama_jenis_hewan) }}"
                                    required
                                >

                                @error('nama_jenis_hewan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i> Simpan Perubahan
                                </button>

                                <a href="{{ route('admin.jenis-hewan.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left"></i> Kembali
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
