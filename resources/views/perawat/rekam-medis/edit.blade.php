@extends('layouts.admin')

@section('title', 'Edit Anamnesa')
@section('page-title', 'Edit Anamnesa')

@section('content')
<div class="form-container-custom">
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card-custom">
        <div class="card-header-custom">
            <h5>Form Edit Anamnesa</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('perawat.rekam-medis.update', $rekam->idrekam_medis) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="alert alert-info">
                    ID Rekam Medis: #{{ $rekam->idrekam_medis }}<br>
                    Nama Hewan: {{ $rekam->nama_hewan ?? '-' }}
                </div>

                <div class="form-group">
                    <label>Anamnesa</label>
                    <textarea name="anamnesa" class="form-control" rows="4" required>{{ old('anamnesa', $rekam->anamnesa) }}</textarea>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                    <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
