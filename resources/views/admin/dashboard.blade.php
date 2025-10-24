@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <h2 class="fw-bold mb-4">Dashboard Admin</h2>

    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-grid-3x3-gap fs-1 text-primary"></i>
                    <h5 class="mt-3">Total Jenis Hewan</h5>
                    <h3>{{ $totalJenisHewan }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
