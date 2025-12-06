@extends('layouts.admin')

@section('title', 'Tambah Rekam Medis')
@section('page-title', 'Tambah Rekam Medis')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Tambah Rekam Medis</h1>
        <p class="page-subtitle-custom">Buat rekam medis baru untuk pasien hewan</p>
    </div>

    {{-- ✅ Alert Error --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card-custom">
        <div class="card-header-custom create-header">
            <h5 class="card-title-custom">
                <i class="bi bi-plus-circle"></i> Form Tambah Rekam Medis
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('perawat.rekam-medis.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="idreservasi_dokter" class="form-label-custom">
                        <i class="bi bi-calendar-check"></i> Reservasi Dokter
                    </label>
                    <select 
                        name="idreservasi_dokter" 
                        id="idreservasi_dokter" 
                        class="form-select-custom @error('idreservasi_dokter') is-invalid @enderror"
                        required
                    >
                        <option value="">-- Pilih Reservasi --</option>
                        @forelse($reservasi as $res)
                            <option value="{{ $res->idreservasi_dokter }}" 
                                {{ old('idreservasi_dokter') == $res->idreservasi_dokter ? 'selected' : '' }}>
                                ID: {{ $res->idreservasi_dokter }} - 
                                {{ $res->pet->nama ?? 'Pet tidak ditemukan' }} 
                                ({{ $res->waktu_daftar ? \Carbon\Carbon::parse($res->waktu_daftar)->format('d/m/Y H:i') : '-' }})
                            </option>
                        @empty
                            <option value="" disabled>Tidak ada reservasi yang tersedia</option>
                        @endforelse
                    </select>
                    @error('idreservasi_dokter')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Pilih reservasi dokter yang sudah selesai pemeriksaan (Status: S)</small>
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
                    >{{ old('anamnesa') }}</textarea>
                    @error('anamnesa')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Catatan keluhan dan riwayat kesehatan pasien (max 1000 karakter)</small>
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
                    >{{ old('temuan_klinis') }}</textarea>
                    @error('temuan_klinis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Hasil observasi dan pemeriksaan klinis (max 1000 karakter)</small>
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
                    >{{ old('diagnosa') }}</textarea>
                    @error('diagnosa')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    <small class="form-help-text">Kesimpulan diagnosis dari pemeriksaan (max 1000 karakter)</small>
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-save"></i> Simpan Rekam Medis
                    </button>
                    <a href="{{ route('perawat.rekam-medis.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection