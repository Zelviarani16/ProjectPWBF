@extends('layouts.admin')

@section('title', 'Tambah Pemilik')
@section('page-title', 'Pemilik')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Tambah Data Pemilik</h1>
        <p class="page-subtitle-custom">Masukkan informasi lengkap pemilik hewan</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom create-header">
            <h5 class="card-title-custom"><i class="bi bi-plus-circle"></i> Form Tambah Pemilik</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('resepsionis.pemilik.store') }}" method="POST">
                @csrf

                {{-- User --}}
                <div class="form-group">
                    <label for="iduser" class="form-label-custom">User Terkait</label>
                    <select name="iduser" id="iduser" class="form-control-custom @error('iduser') is-invalid @enderror" required>
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->iduser }}" {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
                                {{ $user->nama }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('iduser')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="form-group">
                    <label for="alamat" class="form-label-custom">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control-custom @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- No WA --}}
                <div class="form-group">
                    <label for="no_wa" class="form-label-custom">No WhatsApp</label>
                    <input type="text" name="no_wa" id="no_wa" class="form-control-custom @error('no_wa') is-invalid @enderror" value="{{ old('no_wa') }}" required>
                    @error('no_wa')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom"><i class="bi bi-save"></i> Simpan</button>
                    <a href="{{ route('resepsionis.pemilik.index') }}" class="btn-secondary-custom"><i class="bi bi-x-circle"></i> Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
