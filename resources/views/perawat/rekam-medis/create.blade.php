@extends('layouts.lte.main')

@section('title', 'Tambah Anamnesa')
@section('page-title', 'Tambah Anamnesa')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tambah Anamnesa</h3>
                <p class="text-muted">Form pengisian anamnesa pasien</p>
            </div>
        </div>
    </div>
</div>
<!-- /App Content Header -->

<!-- App Content -->
<div class="app-content">
    <div class="container-fluid">

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">

                <!-- Card Form -->
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-file-medical"></i> Form Tambah Anamnesa
                        </h3>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('perawat.rekam-medis.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Reservasi Dokter</label>
                                <select name="idreservasi_dokter" class="form-select" required>
                                    <option value="">-- Pilih Reservasi --</option>
                                    @forelse($reservasi as $res)
                                        <option value="{{ $res->idreservasi_dokter }}">
                                            {{ $res->nama_hewan ?? '-' }} — Dokter: {{ $res->nama_dokter ?? '-' }}
                                        </option>
                                    @empty
                                        <option disabled>Tidak ada reservasi tersedia</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Anamnesa</label>
                                <textarea
                                    name="anamnesa"
                                    class="form-control"
                                    rows="4"
                                    placeholder="Keluhan / riwayat penyakit..."
                                    required
                                >{{ old('anamnesa') }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-success">
                                    Simpan
                                </button>

                                <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary">
                                    Batal
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
