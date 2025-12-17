@extends('layouts.lte.main')

@section('title', 'Tambah Reservasi Temu Dokter')
@section('page-title', 'Tambah Reservasi Temu Dokter')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tambah Reservasi Temu Dokter</h3>
                <p class="text-muted">Masukkan data reservasi baru</p>
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
                            <i class="bi bi-plus-circle"></i> Form Tambah Reservasi
                        </h3>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('resepsionis.temu-dokter.store') }}" method="POST">
                            @csrf

                            {{-- Pet --}}
                            <div class="mb-3">
                                <label class="form-label">Pilih Hewan</label>
                                <select name="idpet" class="form-control" required>
                                    <option value="">-- Pilih Hewan --</option>
                                    @foreach($pets as $p)
                                        <option value="{{ $p->idpet }}">
                                            {{ $p->nama }} ({{ $p->pemilik->user->nama }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Dokter --}}
                            <div class="mb-4">
                                <label class="form-label">Pilih Dokter</label>
                                <select name="idrole_user" class="form-control" required>
                                    <option value="">-- Pilih Dokter --</option>
                                    @foreach($dokters as $d)
                                        <option value="{{ $d->idrole_user }}">
                                            {{ $d->user->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle"></i> Simpan
                                </button>

                                <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-secondary">
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
