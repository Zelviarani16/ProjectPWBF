@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }} - {{ session('user_name') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} {{ session('user_role_name') }}

                    {{-- 🔹 Kondisi berdasarkan ID role --}}
                    @php
                        $roleId = session('user_role_id');
                    @endphp

                    @if ($roleId == 1)
                        {{-- Admin --}}
                        <div class="mt-4">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-cogs"></i> Menu Admin
                            </a>
                        </div>
                    @elseif ($roleId == 2)
                        {{-- Dokter --}}
                        <div class="mt-4">
                            <a href="{{ route('dokter.dashboard') }}" class="btn btn-success btn-block">
                                <i class="fas fa-stethoscope"></i> Menu Dokter
                            </a>
                        </div>
                    @elseif ($roleId == 3)
                        {{-- Perawat --}}
                        <div class="mt-4">
                            <a href="{{ route('perawat.dashboard') }}" class="btn btn-info btn-block">
                                <i class="fas fa-user-nurse"></i> Menu Perawat
                            </a>
                        </div>
                    @elseif ($roleId == 4)
                        {{-- Resepsionis --}}
                        <div class="mt-4">
                            <a href="{{ route('resepsionis.dashboard') }}" class="btn btn-warning btn-block">
                                <i class="fas fa-concierge-bell"></i> Menu Resepsionis
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
