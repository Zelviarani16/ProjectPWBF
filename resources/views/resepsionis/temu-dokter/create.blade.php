@extends('layouts.admin')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Tambah Reservasi Temu Dokter</h1>
        <p class="page-subtitle-custom">Masukkan data reservasi baru</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom create-header">
            <h5 class="card-title-custom"><i class="bi bi-plus-circle"></i> Form Tambah Reservasi</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('resepsionis.temu-dokter.store') }}" method="POST">
                @csrf

                {{-- Pet --}}
                <div class="form-group">
                    <label class="form-label-custom">Pilih Hewan</label>
                    <select name="idpet" class="form-control-custom" required>
                        <option value="">-- Pilih Hewan --</option>
                        @foreach($pets as $p)
                        <option value="{{ $p->idpet }}">
                            {{ $p->nama }} ({{ $p->pemilik->user->nama }})
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Dokter --}}
                <div class="form-group">
                    <label class="form-label-custom">Pilih Dokter</label>
                    <select name="idrole_user" class="form-control-custom" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($dokters as $d)
                        <option value="{{ $d->idrole_user }}">
                            {{ $d->user->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom"><i class="bi bi-check-circle"></i> Simpan</button>
                    <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn-secondary-custom"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
