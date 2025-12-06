@extends('layouts.admin')

@section('title', 'Detail Rekam Medis')
@section('page-title', 'Detail Rekam Medis')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Detail Rekam Medis</h1>
    <p class="page-subtitle-custom">Informasi lengkap rekam medis pasien hewan</p>
</div>

<!-- Info Card Pasien -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card-custom">
            <div class="card-header-custom" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <h5 class="card-title-custom text-white mb-0">
                    <i class="bi bi-person-badge"></i> Informasi Pasien
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="info-item-custom">
                            <label>ID Rekam Medis</label>
                            <p class="info-value">#{{ $rekam->idrekam_medis }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-item-custom">
                            <label>ID Reservasi</label>
                            <p class="info-value">#{{ $rekam->idreservasi_dokter }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-item-custom">
                            <label>Nama Hewan</label>
                            <p class="info-value">{{ $rekam->reservasi->pet->nama ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-item-custom">
                            <label>Pemilik</label>
                            <p class="info-value">{{ $rekam->reservasi->pet->pemilik->user->nama ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="info-item-custom">
                            <label>Jenis Hewan</label>
                            <p class="info-value">{{ $rekam->reservasi->pet->ras->jenisHewan->nama_jenis_hewan ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-item-custom">
                            <label>Ras</label>
                            <p class="info-value">{{ $rekam->reservasi->pet->ras->nama_ras ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-item-custom">
                            <label>Dokter Pemeriksa</label>
                            <p class="info-value">{{ $rekam->nama_dokter }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-item-custom">
                            <label>Tanggal Pemeriksaan</label>
                            <p class="info-value">{{ $rekam->created_at ? $rekam->created_at->format('d F Y, H:i') : '-' }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Anamnesa, Temuan, Diagnosa -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card-custom">
            <div class="card-header-custom" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <h5 class="card-title-custom text-white mb-0">
                    <i class="bi bi-clipboard2-pulse"></i> Hasil Pemeriksaan
                </h5>
            </div>
            <div class="card-body">

                <div class="detail-section-custom">
                    <div class="detail-label-custom">
                        <i class="bi bi-chat-left-text text-primary"></i> Anamnesa
                    </div>
                    <div class="detail-content-custom">
                        {{ $rekam->anamnesa }}
                    </div>
                </div>

                <div class="detail-section-custom">
                    <div class="detail-label-custom">
                        <i class="bi bi-clipboard-pulse text-success"></i> Temuan Klinis
                    </div>
                    <div class="detail-content-custom">
                        {{ $rekam->temuan_klinis }}
                    </div>
                </div>

                <div class="detail-section-custom">
                    <div class="detail-label-custom">
                        <i class="bi bi-file-medical text-danger"></i> Diagnosa
                    </div>
                    <div class="detail-content-custom">
                        {{ $rekam->diagnosa }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- DETAIL TINDAKAN & TERAPI -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card-custom">
            <div class="card-header-custom" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                <h5 class="card-title-custom text-white mb-0">
                    <i class="bi bi-clipboard-check"></i> Detail Tindakan & Terapi
                </h5>
            </div>

            <div class="card-body">

                @if($rekam->detail && $rekam->detail->count() > 0)
                    <div class="table-responsive">
                        <table class="table-custom">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">Kode Tindakan</th>
                                    <th width="55%">Detail Tindakan</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rekam->detail as $index => $detail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>

                                        <td>
                                            <span class="badge-custom badge-info">
                                                {{ $detail->kodeTindakanTerapi->kode ?? '-' }}
                                                — {{ $detail->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? '-' }}
                                            </span>
                                        </td>

                                        <td>{{ $detail->detail }}</td>

                                        <td>
                                            <div class="action-buttons-custom">

                                                {{-- EDIT --}}
                                                <a href="{{ route('dokter.rekam-medis.detail.edit', $detail->iddetail_rekam_medis) }}"
                                                   class="btn-warning-custom" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                {{-- DELETE --}}
                                                <form action="{{ route('dokter.rekam-medis.detail.destroy', $detail->iddetail_rekam_medis) }}"
                                                      method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn-danger-custom"
                                                            onclick="return confirm('Yakin ingin menghapus detail tindakan ini?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state-custom text-center py-4">
                        <i class="bi bi-inbox fs-1 mb-2"></i>
                        <p class="mb-0">Belum ada detail tindakan untuk rekam medis ini</p>
                        <small class="text-muted">Detail tindakan akan ditambahkan oleh dokter</small>
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('dokter.rekam-medis.detail.create', $rekam->idrekam_medis) }}"
                       class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Tambah Tindakan
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Action Buttons -->
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <a href="{{ route('dokter.rekam-medis.index') }}" class="btn-secondary-custom">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
        </div>
    </div>
</div>


{{-- STYLE --}}
<style>
/* Custom */
.info-item-custom {
    margin-bottom: 1rem;
}
.info-item-custom label {
    font-size: 0.85rem;
    color: #6c757d;
    font-weight: 600;
}
.info-item-custom .info-value {
    font-size: 1rem;
    font-weight: 500;
}

.detail-section-custom {
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #e2e8f0;
}
.detail-label-custom {
    font-size: 0.95rem;
    font-weight: 700;
    display: flex;
    gap: 0.5rem;
}

.detail-content-custom {
    background: #f7fafc;
    padding: 1rem;
    border-radius: 8px;
    border-left: 4px solid #667eea;
}

.badge-info {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Print */
@media print {
    .btn-secondary-custom,
    .page-header-custom,
    .card-header-custom {
        display: none !important;
    }
}
</style>

@endsection
