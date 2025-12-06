@extends('layouts.admin')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Edit Pet</h1>
        <p class="page-subtitle-custom">Ubah data pet</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom edit-header">
            <h5 class="card-title-custom"><i class="bi bi-pencil-square"></i> Form Edit Pet</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.pet.update', $pet->idpet) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama" class="form-label-custom">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control-custom @error('nama') is-invalid @enderror"
                           value="{{ old('nama', $pet->nama) }}" required>
                    @error('nama') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir" class="form-label-custom">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control-custom @error('tanggal_lahir') is-invalid @enderror"
                           value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}" required>
                    @error('tanggal_lahir') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="warna_tanda" class="form-label-custom">Warna / Tanda</label>
                    <input type="text" name="warna_tanda" id="warna_tanda" class="form-control-custom @error('warna_tanda') is-invalid @enderror"
                           value="{{ old('warna_tanda', $pet->warna_tanda) }}">
                    @error('warna_tanda') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label for="jenis_kelamin" class="form-label-custom">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control-custom" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="L" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="idpemilik" class="form-label-custom">Pemilik</label>
                    <select name="idpemilik" id="idpemilik" class="form-control-custom @error('idpemilik') is-invalid @enderror" required>
                        <option value="">-- Pilih Pemilik --</option>
                        @foreach($pemilik as $p)
                            <option value="{{ $p->idpemilik }}" {{ old('idpemilik', $pet->idpemilik) == $p->idpemilik ? 'selected' : '' }}>
                                {{ $p->nama_user }}
                            </option>
                        @endforeach
                    </select>
                    @error('idpemilik')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="idras_hewan" class="form-label-custom">Ras Hewan</label>
                    <select name="idras_hewan" id="idras_hewan" class="form-control-custom" required>
                        <option value="">-- Pilih Ras Hewan --</option>
                        @foreach($rasHewan as $r)
                            <option value="{{ $r->idras_hewan }}" {{ old('idras_hewan', $pet->idras_hewan) == $r->idras_hewan ? 'selected' : '' }}>
                                {{ $r->nama_ras }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom"><i class="bi bi-check-circle"></i> Simpan Perubahan</button>
                    <a href="{{ route('admin.pet.index') }}" class="btn-secondary-custom"><i class="bi bi-arrow-left"></i> Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
