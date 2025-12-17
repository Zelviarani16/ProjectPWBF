@extends('layouts.admin')

@section('title', 'Detail Rekam Medis')
@section('page-title', 'Detail Rekam Medis')

@section('content')
<div class="page-header-custom">
    <h1>Detail Rekam Medis</h1>
    <p>Informasi lengkap rekam medis pasien hewan</p>
</div>

<div class="card-custom mb-4">
    <div class="card-body">
        <p><strong>ID Rekam Medis:</strong> #{{ $rekam->idrekam_medis }}</p>
        <p><strong>Nama Hewan:</strong> {{ $rekam->nama_hewan ?? '-' }}</p>
        <p><strong>Pemilik:</strong> {{ $rekam->nama_pemilik ?? '-' }}</p>
        <p><strong>Status:</strong> {{ $rekam->status }}</p>
        <p><strong>Anamnesa:</strong><br>{{ $rekam->anamnesa }}</p>

        @if(!empty($detail) && $detail->count() > 0)
            <h5>Detail Tindakan / Terapi (Dokter)</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode dan Tindakan</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detail as $index => $d)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $d->kode ?? '-' }} — {{ $d->deskripsi_tindakan_terapi ?? '-' }}</td>
</td>
                            <td>{{ $d->detail }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted">Belum ada tindakan dokter. Perawat hanya mengisi anamnesa.</p>
        @endif
    </div>
</div>

<a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
