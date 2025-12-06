@extends('layouts.admin')

@section('title', 'Edit Detail Rekam Medis')
@section('page-title', 'Edit Detail Rekam Medis')

@section('content')
<div class="card-custom">
    <div class="card-header-custom">
        <h5 class="mb-0">Edit Detail Rekam Medis</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('dokter.rekam-medis.detail.update', $detail->iddetail_rekam_medis) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Jenis Tindakan</label>
                <select name="idkode_tindakan_terapi" class="form-select" required>
                    @foreach($tindakan as $t)
                        <option value="{{ $t->idkode_tindakan_terapi }}"
                            {{ $detail->idkode_tindakan_terapi == $t->idkode_tindakan_terapi ? 'selected' : '' }}>
                            {{ $t->deskripsi_tindakan_terapi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Detail Tindakan</label>
                <textarea name="detail" class="form-control" rows="4" required>{{ $detail->detail }}</textarea>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('dokter.rekam-medis.showDetail', $detail->idrekam_medis) }}" class="btn-secondary-custom">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn-primary-custom">
                    <i class="bi bi-save"></i> Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
