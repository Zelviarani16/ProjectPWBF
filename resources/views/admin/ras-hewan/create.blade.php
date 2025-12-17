@extends('layouts.lte.main')

@section('title', 'Tambah Ras Hewan')
@section('page-title', 'Tambah Ras Hewan')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tambah Ras Hewan</h3>
                <p class="text-muted">Tambah ras hewan baru ke dalam sistem</p>
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
                            <i class="bi bi-plus-circle"></i> Form Tambah Ras Hewan
                        </h3>
                    </div>

                    <div class="card-body">
                        <!-- ketika klik simpan dgn type submit, maka lnsgng diarahkan ke contorller store -->
                        <form action="{{ route('admin.ras-hewan.store') }}" method="POST">
                            @csrf

                            <!-- Nama Ras -->
                            <div class="mb-3">
                                <label for="nama_ras" class="form-label">
                                    Nama Ras
                                </label>

                                <input
                                    type="text"
                                    name="nama_ras"
                                    id="nama_ras"
                                    class="form-control @error('nama_ras') is-invalid @enderror"
                                    value="{{ old('nama_ras') }}"
                                    required
                                >

                                @error('nama_ras')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <small class="form-text text-muted">
                                    Masukkan nama ras hewan
                                </small>
                            </div>

                            <!-- Jenis Hewan -->
                            <div class="mb-3">
                                <label for="idjenis_hewan" class="form-label">
                                    Jenis Hewan
                                </label>

                                <select
                                    name="idjenis_hewan"
                                    id="idjenis_hewan"
                                    class="form-control @error('idjenis_hewan') is-invalid @enderror"
                                    required
                                >
                                    <option value="">-- Pilih Jenis Hewan --</option>
                                    @foreach($jenisHewan as $jenis)
                                    <!-- yg dikirim ke server adalah id nya, tetapi tetap di dropdown yg ditampilkan adalah nama nya -->
                                        <option value="{{ $jenis->idjenis_hewan }}" 
                                            {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}> 
                                            {{ $jenis->nama_jenis_hewan }}
                                        </option>
                                    @endforeach
                                </select>
                                <!-- old berguna saat disubmit dan validasi gagal (bisa krn ada salah satu field yg belum terisi) maka di dropdown tetap menampilkan yg sudah dipilih (old) tidak default reset ke pilih jenishewan lagi -->

                                @error('idjenis_hewan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <small class="form-text text-muted">
                                    Pilih jenis hewan yang sesuai
                                </small>
                            </div>

                            <!-- Button -->
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Simpan
                                </button>

                                <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary">
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
