@extends('layouts.lte.main')

@section('title', 'Tambah Pemilik')
@section('page-title', 'Pemilik')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tambah Data Pemilik</h3>
                <p class="text-muted">Masukkan informasi lengkap pemilik hewan</p>
            </div>
        </div>
    </div>
</div>
<!-- /App Content Header -->

<!-- App Content -->
<div class="app-content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <!-- Card Form -->
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-plus-circle"></i> Form Tambah Pemilik
                        </h3>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('resepsionis.pemilik.store') }}" method="POST">
                            @csrf

                            {{-- User --}}
                            <div class="mb-3">
                                <label for="iduser" class="form-label">User Terkait</label>
                                <select 
                                    name="iduser" 
                                    id="iduser" 
                                    class="form-control @error('iduser') is-invalid @enderror" 
                                    required
                                >
                                    <option value="">-- Pilih User --</option>
                                    @foreach($users as $user)
                                        <option 
                                            value="{{ $user->iduser }}" 
                                            {{ old('iduser') == $user->iduser ? 'selected' : '' }}
                                        >
                                            {{ $user->nama }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('iduser')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Alamat --}}
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea 
                                    name="alamat" 
                                    id="alamat" 
                                    class="form-control @error('alamat') is-invalid @enderror" 
                                    rows="3" 
                                    required
                                >{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- No WA --}}
                            <div class="mb-4">
                                <label for="no_wa" class="form-label">No WhatsApp</label>
                                <input 
                                    type="text" 
                                    name="no_wa" 
                                    id="no_wa" 
                                    class="form-control @error('no_wa') is-invalid @enderror" 
                                    value="{{ old('no_wa') }}" 
                                    required
                                >
                                @error('no_wa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Simpan
                                </button>

                                <a href="{{ route('resepsionis.pemilik.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                            </div>

                        </form>

                    </div>
                </div>
                <!-- /Card -->

            </div>
        </div>

    </div>
</div>
<!-- /App Content -->

@endsection
