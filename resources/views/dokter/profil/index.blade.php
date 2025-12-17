@extends('layouts.lte.main')

@section('title', 'Profil Dokter')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Profil Dokter</h3>
            </div>
        </div>
    </div>
</div>
<!-- /App Content Header -->


<!-- App Content -->
<div class="app-content">
    <div class="container-fluid">

        <!-- <a href="{{ route('dokter.profil.edit') }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Edit Profil
        </a> -->

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


        <div class="row">

            <!-- KIRI -->
            <div class="col-lg-8">

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-person-circle"></i> Informasi Akun
                        </h5>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Nama Lengkap</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $user->nama ?? '-' }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Email</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $user->email ?? '-' }}
                            </div>
                        </div>

                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-clipboard-pulse"></i> Informasi Dokter
                        </h5>
                    </div>
                    <div class="card-body">

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Alamat</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $dokter->alamat ?: '-' }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>No. HP</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $dokter->no_hp ?: '-' }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Bidang</strong>
                            </div>
                            <div class="col-md-8">
                                {{ $dokter->bidang_dokter ?: '-' }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Jenis Kelamin</strong>
                            </div>
                            <div class="col-md-8">
                                @if($dokter->jenis_kelamin == 'L')
                                    <span class="badge bg-primary">Laki-laki</span>
                                @elseif($dokter->jenis_kelamin == 'P')
                                    <span class="badge bg-danger">Perempuan</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>


            <!-- KANAN -->
            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body text-center">

                        <div class="mb-3">
                            <i class="bi bi-person-circle" style="font-size: 100px; color: #0d6efd;"></i>
                        </div>

                        <h5>{{ $user->nama }}</h5>
                        <p class="text-muted mb-3">Dokter</p>

                        <a href="{{ route('dokter.profil.edit') }}" class="btn btn-outline-primary w-100">
                            <i class="bi bi-pencil-square"></i> Edit Profil
                        </a>

                    </div>
                </div>


                <div class="card mt-3">
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
