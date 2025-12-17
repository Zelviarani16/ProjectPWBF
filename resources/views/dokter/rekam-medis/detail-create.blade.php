@extends('layouts.lte.main')

@section('title', 'Detail Rekam Medis')
@section('page-title', 'Detail Rekam Medis')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <h3 class="mb-0">Detail Rekam Medis</h3>
        <p class="text-muted">Informasi lengkap rekam medis pasien hewan</p>
    </div>
</div>

<!-- App Content -->
<div class="app-content">
    <div class="container-fluid">

        <!-- Informasi Pasien -->
        <div class="card mb-4">
            <div class="card-header bg-warning">
                <h3 class="card-title">
                    <i class="bi bi-person-badge"></i> Informasi Pasien
                </h3>
            </div>

            <div class="card-body">
                <div class="row text-sm">
                    <div class="col-md-3 mb-3">
                        <strong>ID Rekam Medis</strong>
                        <div>#{{ $rekam->idrekam_medis }}</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong>ID Reservasi</strong>
                        <div>#{{ $rekam->idreservasi_dokter }}</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong>Nama Hewan</strong>
                        <div>{{ $rekam->nama_pet ?? '-' }}</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong>Pemilik</strong>
                        <div>{{ $rekam->nama_pemilik ?? '-' }}</div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <strong>Jenis Hewan</strong>
                        <div>{{ $rekam->nama_jenis_hewan ?? '-' }}</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong>Ras</strong>
                        <div>{{ $rekam->nama_ras ?? '-' }}</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong>Dokter Pemeriksa</strong>
                        <div>{{ $rekam->nama_dokter ?? '-' }}</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <strong>Tanggal Pemeriksaan</strong>
                        <div>{{ \Carbon\Carbon::parse($rekam->created_at)->format('d F Y, H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hasil Pemeriksaan -->
        <div class="card mb-4">
            <div class="card-header bg-warning">
                <h3 class="card-title">
                    <i class="bi bi-clipboard2-pulse"></i> Hasil Pemeriksaan
                </h3>
            </div>

            <div class="card-body">
                <form action="{{ route('dokter.rekam-medis.detail.store', $rekam->idrekam_medis) }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Anamnesa (Perawat)</label>
                        <textarea class="form-control" rows="3" disabled>{{ $rekam->anamnesa ?? '-' }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Temuan Klinis</label>
                        <textarea name="temuan_klinis" class="form-control" rows="3"
                            @if($rekam->status_reservasi === 'S') disabled @endif>{{ old('temuan_klinis', $rekam->temuan_klinis) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Diagnosa</label>
                        <textarea name="diagnosa" class="form-control" rows="3"
                            @if($rekam->status_reservasi === 'S') disabled @endif>{{ old('diagnosa', $rekam->diagnosa) }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kode Tindakan Terapi</label>
                        <select name="idkode_tindakan_terapi" class="form-select"
                            @if($rekam->status_reservasi === 'S') disabled @endif>
                            <option value="">-- Pilih Kode Tindakan Terapi --</option>
                            @foreach($kodeTindakan as $t)
                                <option value="{{ $t->idkode_tindakan_terapi }}">
                                    {{ $t->kode }} - {{ $t->deskripsi_tindakan_terapi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Detail Tindakan</label>
                        <textarea name="detail" class="form-control" rows="3"
                            @if($rekam->status_reservasi === 'S') disabled @endif>{{ old('detail') }}</textarea>
                    </div>

                    @if($rekam->status_reservasi !== 'S')
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Simpan / Tambah Detail
                        </button>
                    @endif
                </form>
            </div>
        </div>

        <!-- Tabel Detail Tindakan -->
        <div class="card mb-4">
            <div class="card-header bg-warning">
                <h3 class="card-title">
                    <i class="bi bi-clipboard-check"></i> Detail Tindakan & Terapi
                </h3>
            </div>

            <div class="card-body">
                @if($detail->count())
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Tindakan</th>
                                    <th>Detail</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detail as $i => $d)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $d->kode }} - {{ $d->deskripsi_tindakan_terapi }}
                                        </span>
                                    </td>
                                    <td>{{ $d->detail }}</td>
                                    <td>
                                        @if($rekam->status_reservasi !== 'S')
                                            <a href="{{ route('dokter.rekam-medis.detail.edit', $d->iddetail_rekam_medis) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            <form action="{{ route('dokter.rekam-medis.detail.destroy', $d->iddetail_rekam_medis) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin hapus?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <span class="badge bg-secondary">Terkunci</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted py-4">
                        <i class="bi bi-inbox fs-2"></i>
                        <p class="mb-0">Belum ada detail tindakan</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Action -->
        <div class="d-flex justify-content-between">
            <a href="{{ route('dokter.rekam-medis.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            @if($rekam->status_reservasi !== 'S')
                <form action="{{ route('dokter.pasien.selesai', $rekam->idreservasi_dokter) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger"
                        onclick="return confirm('Yakin menyelesaikan pemeriksaan?')">
                        <i class="bi bi-check-circle"></i> Selesaikan Pemeriksaan
                    </button>
                </form>
            @endif
        </div>

    </div>
</div>

@endsection
