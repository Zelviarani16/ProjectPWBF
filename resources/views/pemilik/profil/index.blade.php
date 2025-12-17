@extends('layouts.lte.main')

@section('title', 'Profil Pemilik')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Profil Pemilik</h3>
                <p class="text-muted">Informasi akun dan kontak Anda</p>
            </div>
        </div>
    </div>
</div>
<!-- /App Content Header -->

<!-- App Content -->
<div class="app-content">
    <div class="container-fluid">

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row g-3 align-items-stretch">

            <!-- KIRI -->
            <div class="col-lg-8 d-flex flex-column">
                <div class="card mb-3 flex-fill">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-person-circle"></i> Informasi Akun</h5>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-4"><strong>Nama Lengkap</strong></div>
                            <div class="col-md-8">{{ $user->nama ?? '-' }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4"><strong>Email</strong></div>
                            <div class="col-md-8">{{ $user->email ?? '-' }}</div>
                        </div>

                    </div>
                </div>

                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="bi bi-clipboard-pulse"></i> Informasi Pemilik</h5>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-4"><strong>Alamat</strong></div>
                            <div class="col-md-8">{{ $pemilik->alamat ?: '-' }}</div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4"><strong>No WA</strong></div>
                            <div class="col-md-8">{{ $pemilik->no_wa ?: '-' }}</div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- KANAN -->
            <div class="col-lg-4 d-flex flex-column">
                <div class="card flex-fill mb-3">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-person-circle" style="font-size: 100px; color: #0d6efd;"></i>
                        </div>
                        <h5>{{ $user->nama }}</h5>
                        <p class="text-muted mb-3">Pemilik</p>
                        <a href="{{ route('pemilik.profil.edit') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-pencil-square"></i> Edit Profil
                        </a>
                    </div>
                </div>

                <div class="card flex-fill">
                    <div class="card-body">
                        <h6 class="card-title">Informasi Tambahan</h6>
                        <hr>
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i> 
                            Pastikan data profil Anda selalu ter-update untuk keperluan administrasi.
                        </small>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection
