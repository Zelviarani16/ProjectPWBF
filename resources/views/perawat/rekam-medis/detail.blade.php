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

<!-- Detail Tindakan/Terapi (jika ada) -->
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
                                    <th width="30%">Kode Tindakan</th>
                                    <th width="65%">Detail Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($rekam->detail as $index => $detail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <span class="badge-custom badge-info">
                                                {{ $detail->kodeTindakan->nama_tindakan ?? '-' }}
                                            </span>
                                        </td>
                                        <td>{{ $detail->detail }}</td>
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
            </div>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            <a href="{{ route('perawat.rekam-medis.index') }}" class="btn-secondary-custom">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
            </a>
            
            <!-- <div>
                <button onclick="window.print()" class="btn-info-custom">
                    <i class="bi bi-printer"></i> Cetak
                </button>
            </div> -->
        </div>
    </div>
</div>

<style>
    /* Custom Styles untuk Detail Page */
    .info-item-custom {
        margin-bottom: 1rem;
    }
    
    .info-item-custom label {
        font-size: 0.85rem;
        color: #6c757d;
        font-weight: 600;
        margin-bottom: 0.25rem;
        display: block;
    }
    
    .info-item-custom .info-value {
        font-size: 1rem;
        color: #2d3748;
        font-weight: 500;
        margin-bottom: 0;
    }
    
    .detail-section-custom {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .detail-section-custom:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    
    .detail-label-custom {
        font-size: 0.95rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .detail-content-custom {
        font-size: 0.95rem;
        color: #4a5568;
        line-height: 1.6;
        padding: 1rem;
        background: #f7fafc;
        border-radius: 8px;
        border-left: 4px solid #667eea;
    }
    
    .badge-custom {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    
    .badge-info {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    
    /* Print Styles */
    @media print {
        .btn-secondary-custom,
        .btn-info-custom,
        .page-header-custom,
        .card-header-custom {
            display: none !important;
        }
        
        .card-custom {
            box-shadow: none !important;
            border: 1px solid #ddd;
        }
    }
</style>
@endsection