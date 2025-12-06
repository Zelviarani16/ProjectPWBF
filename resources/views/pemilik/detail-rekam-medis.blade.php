@extends('layouts.admin')

@section('title', 'Detail Rekam Medis')
@section('page-title', 'Detail Rekam Medis')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Detail Rekam Medis</h1>
    <p class="page-subtitle-custom">Informasi lengkap rekam medis hewan</p>
</div>

<div class="card-custom">
    <div class="card-body">
        <p><strong>Diagnosa:</strong> {{ $rekamMedis->diagnosa }}</p>
        <p><strong>Anamnesa:</strong> {{ $rekamMedis->anamnesa }}</p>
        <p><strong>Temuan Klinis:</strong> {{ $rekamMedis->temuan_klinis }}</p>

        <h5 class="mt-3">Detail Tindakan</h5>
        <ul>
            @foreach($rekamMedis->detail as $d)
                <li>{{ $d->kodeTindakanTerapi->deskripsi_tindakan_terapi ?? $d->detail }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
