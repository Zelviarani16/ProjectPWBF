@extends('layouts.admin')

@section('title', 'Profil Pemilik')
@section('page-title', 'Profil Saya')

@section('content')
<div class="page-header-custom">
    <h1 class="page-title-custom">Profil Pemilik</h1>
    <p class="page-subtitle-custom">Informasi akun dan kontak Anda</p>
</div>

<div class="card-custom">
    <div class="card-body">
        <p><strong>Nama:</strong> {{ $user->nama }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Alamat:</strong> {{ $pemilik->alamat }}</p>
        <p><strong>No WA:</strong> {{ $pemilik->no_wa }}</p>
    </div>
</div>
@endsection
