@extends('layouts.admin')

@section('title', 'Tambah Pet')
@section('page-title', 'Tambah Pet')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Tambah Pet</h1>
        <p class="page-subtitle-custom">Masukkan data hewan peliharaan baru beserta pemiliknya</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom create-header">
            <h5 class="card-title-custom">
                <i class="bi bi-plus-circle"></i> Form Tambah Pet
            </h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.pet.store') }}" method="POST">
                @csrf

                {{-- Nama Pet --}}
                <div class="form-group">
                    <label for="nama" class="form-label-custom">Nama Pet</label>
                    <input type="text" 
                           name="nama" 
                           id="nama" 
                           class="form-control-custom @error('nama') is-invalid @enderror"
                           value="{{ old('nama') }}" required>
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tanggal Lahir --}}
                <div class="form-group">
                    <label for="tanggal_lahir" class="form-label-custom">Tanggal Lahir</label>
                    <input type="date" 
                           name="tanggal_lahir" 
                           id="tanggal_lahir" 
                           class="form-control-custom @error('tanggal_lahir') is-invalid @enderror"
                           value="{{ old('tanggal_lahir') }}" required>
                    @error('tanggal_lahir')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Warna / Tanda --}}
                <div class="form-group">
                    <label for="warna_tanda" class="form-label-custom">Warna / Tanda</label>
                    <input type="text" 
                           name="warna_tanda" 
                           id="warna_tanda" 
                           class="form-control-custom @error('warna_tanda') is-invalid @enderror"
                           value="{{ old('warna_tanda') }}">
                    @error('warna_tanda')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Jenis Kelamin --}}
                <div class="form-group">
                    <label for="jenis_kelamin" class="form-label-custom">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control-custom @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Jantan</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Betina</option>
                    </select>
                    @error('jenis_kelamin')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Ras Hewan --}}
                <div class="form-group">
                    <label for="idras_hewan" class="form-label-custom">Ras Hewan</label>
                    <select name="idras_hewan" id="idras_hewan" class="form-control-custom @error('idras_hewan') is-invalid @enderror" required>
                        <option value="">-- Pilih Ras Hewan --</option>
                        @foreach($rasHewan as $ras)
                            <option value="{{ $ras->idras_hewan }}" {{ old('idras_hewan') == $ras->idras_hewan ? 'selected' : '' }}>
                                {{ $ras->nama_ras }}
                            </option>
                        @endforeach
                    </select>
                    @error('idras_hewan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Pemilik --}}
                <div class="form-group">
                    <label for="idpemilik" class="form-label-custom">Pemilik</label>
                    <select name="idpemilik" id="idpemilik" class="form-control-custom @error('idpemilik') is-invalid @enderror" required>
                        <option value="">-- Pilih Pemilik --</option>
                        @foreach($pemilik as $p)
                            <option value="{{ $p->idpemilik }}" {{ old('idpemilik') == $p->idpemilik ? 'selected' : '' }}>
                                {{ $p->nama_user }}
                            </option>
                        @endforeach
                    </select>
                    @error('idpemilik')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tombol Aksi --}}
                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-save"></i> Simpan Pet
                    </button>
                    <a href="{{ route('admin.pet.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
