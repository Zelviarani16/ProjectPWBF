@extends('layouts.admin')

@section('title', 'Tambah Detail Rekam Medis')
@section('page-title', 'Tambah Detail Rekam Medis')

@section('content')
<div class="card-custom">
    <div class="card-header-custom">
        <h5 class="mb-0">Tambah Detail Rekam Medis</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('dokter.rekam-medis.detail.store', $rekam->idrekam_medis) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Jenis Tindakan</label>
                <select name="idkode_tindakan_terapi" class="form-select" required>
                    <option value="">-- Pilih Tindakan --</option>
                    @foreach($tindakan as $t)
                        <option value="{{ $t->idkode_tindakan_terapi }}">
                            <!-- revisi nama  -->
                        {{ $t->deskripsi_tindakan_terapi }} 
                        </option>
                    @endforeach
                </select>
                @error('idkode_tindakan_terapi') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Detail Tindakan</label>
                <textarea name="detail" class="form-control" rows="4" required></textarea>
                @error('detail') 
                    <small class="text-danger">{{ $message }}</small> 
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('dokter.rekam-medis.index', $rekam->idrekam_medis) }}" class="btn-secondary-custom">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn-primary-custom">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
