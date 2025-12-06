@extends('layouts.admin')

@section('title', 'Edit Rekam Medis')
@section('page-title', 'Edit Rekam Medis')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Edit Rekam Medis</h1>
        <p class="page-subtitle-custom">Ubah data rekam medis pasien hewan</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom edit-header">
            <h5 class="card-title-custom">
                <i class="bi bi-pencil-square"></i> Form Edit Rekam Medis
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('perawat.rekam-medis.update', $rekam->idrekam_medis) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Info Pasien (Read Only) -->
                <div class="alert alert-info-custom mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>ID Rekam Medis:</strong> #{{ $rekam->idrekam_medis }}</p>
                            <p class="mb-1"><strong>ID Reservasi:</strong> #{{ $rekam->idreservasi_dokter }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Nama Hewan:</strong> {{ $rekam->reservasi->pet->nama ?? '-' }}</p>
                            <p class="mb-1"><strong>Tanggal Dibuat:</strong> {{ $rekam->created_at ? $rekam->created_at->format('d-m-Y H:i') : '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="anamnesa" class="form-label-custom">
                        <i class="bi bi-chat-left-text"></i> Anamnesa
                    </label>
                    <textarea 
                        name="anamnesa" 
                        id="anamnesa" 
                        rows="4"
                        class="form-control-custom @error('anamnesa') is-invalid @enderror"
                        placeholder="Keluhan yang dirasakan hewan, riwayat penyakit sebelumnya..."
                        required
                    >{{ old('anamnesa', $rekam->anamnesa) }}</textarea>
                    @error('anamnesa')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Catatan keluhan dan riwayat kesehatan pasien</small>
                </div>

                <div class="form-group">
                    <label for="temuan_klinis" class="form-label-custom">
                        <i class="bi bi-clipboard-pulse"></i> Temuan Klinis
                    </label>
                    <textarea 
                        name="temuan_klinis" 
                        id="temuan_klinis" 
                        rows="4"
                        class="form-control-custom @error('temuan_klinis') is-invalid @enderror"
                        placeholder="Hasil pemeriksaan fisik, vital signs, dll..."
                        required
                    >{{ old('temuan_klinis', $rekam->temuan_klinis) }}</textarea>
                    @error('temuan_klinis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Hasil observasi dan pemeriksaan klinis</small>
                </div>

                <div class="form-group">
                    <label for="diagnosa" class="form-label-custom">
                        <i class="bi bi-file-medical"></i> Diagnosa
                    </label>
                    <textarea 
                        name="diagnosa" 
                        id="diagnosa" 
                        rows="3"
                        class="form-control-custom @error('diagnosa') is-invalid @enderror"
                        placeholder="Diagnosis penyakit atau kondisi pasien..."
                        required
                    >{{ old('diagnosa', $rekam->diagnosa) }}</textarea>
                    @error('diagnosa')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Kesimpulan diagnosis dari pemeriksaan</small>
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-check-circle"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('perawat.rekam-medis.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection