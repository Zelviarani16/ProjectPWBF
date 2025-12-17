@extends('layouts.lte.main')

@section('title', 'Tambah Pet')
@section('page-title', 'Tambah Pet')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tambah Pet</h3>
                <p class="text-muted">Masukkan data hewan peliharaan baru beserta pemiliknya</p>
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
                            <i class="bi bi-plus-circle"></i> Form Tambah Pet
                        </h3>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('admin.pet.store') }}" method="POST">
                            @csrf

                            {{-- Nama Pet --}}
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pet</label>
                                <input 
                                    type="text" 
                                    name="nama" 
                                    id="nama" 
                                    class="form-control @error('nama') is-invalid @enderror"
                                    value="{{ old('nama') }}" 
                                    required
                                >
                                @error('nama')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input 
                                    type="date" 
                                    name="tanggal_lahir" 
                                    id="tanggal_lahir" 
                                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    value="{{ old('tanggal_lahir') }}" 
                                    required
                                >
                                @error('tanggal_lahir')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Warna / Tanda --}}
                            <div class="mb-3">
                                <label for="warna_tanda" class="form-label">Warna / Tanda</label>
                                <input 
                                    type="text" 
                                    name="warna_tanda" 
                                    id="warna_tanda" 
                                    class="form-control @error('warna_tanda') is-invalid @enderror"
                                    value="{{ old('warna_tanda') }}"
                                >
                                @error('warna_tanda')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select 
                                    name="jenis_kelamin" 
                                    id="jenis_kelamin" 
                                    class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                    required
                                >
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Jantan</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Betina</option>
                                </select>
                                @error('jenis_kelamin')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Ras Hewan --}}
                            <div class="mb-3">
                                <label for="idras_hewan" class="form-label">Ras Hewan</label>
                                <select 
                                    name="idras_hewan" 
                                    id="idras_hewan" 
                                    class="form-select @error('idras_hewan') is-invalid @enderror" 
                                    required
                                >
                                    <option value="">-- Pilih Ras Hewan --</option>
                                    @foreach($rasHewan as $ras)
                                        <option value="{{ $ras->idras_hewan }}" 
                                            {{ old('idras_hewan') == $ras->idras_hewan ? 'selected' : '' }}>
                                            {{ $ras->nama_ras }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idras_hewan')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Pemilik --}}
                            <div class="mb-4">
                                <label for="idpemilik" class="form-label">Pemilik</label>
                                <select 
                                    name="idpemilik" 
                                    id="idpemilik" 
                                    class="form-select @error('idpemilik') is-invalid @enderror" 
                                    required
                                >
                                    <option value="">-- Pilih Pemilik --</option>
                                    @foreach($pemilik as $p)
                                        <option value="{{ $p->idpemilik }}" 
                                            {{ old('idpemilik') == $p->idpemilik ? 'selected' : '' }}>
                                            {{ $p->nama_user }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idpemilik')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Simpan Pet
                                </button>

                                <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">
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
