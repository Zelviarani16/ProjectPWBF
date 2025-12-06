@extends('layouts.admin')

@section('content')
<div class="form-container-custom">
    <div class="page-header-custom">
        <h1 class="page-title-custom">Edit Reservasi</h1>
        <p class="page-subtitle-custom">Ubah data reservasi temu dokter</p>
    </div>

    <div class="card-custom">
        <div class="card-header-custom edit-header">
            <h5 class="card-title-custom"><i class="bi bi-pencil-square"></i> Form Edit Reservasi</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('resepsionis.temu-dokter.update', $reservasi->idreservasi_dokter) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- No Urut --}}
                <div class="form-group">
                    <label class="form-label-custom">No Urut</label>
                    <input type="number" name="no_urut" class="form-control-custom"
                           value="{{ old('no_urut', $reservasi->no_urut) }}" required>
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label class="form-label-custom">Status</label>
                    <select name="status" class="form-control-custom">
                        <option value="A" {{ $reservasi->status == 'A' ? 'selected' : '' }}>Aktif</option>
                        <option value="S" {{ $reservasi->status == 'S' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                {{-- Pet --}}
                <div class="form-group">
                    <label class="form-label-custom">Hewan</label>
                    <select name="idpet" class="form-control-custom">
                        @foreach($pets as $p)
                        <option value="{{ $p->idpet }}" 
                            {{ $reservasi->idpet == $p->idpet ? 'selected' : '' }}>
                            {{ $p->nama }} ({{ $p->pemilik->user->nama }})
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Dokter --}}
                <div class="form-group">
                    <label class="form-label-custom">Dokter</label>
                    <select name="idrole_user" class="form-control-custom">
                        @foreach($dokters as $d)
                        <option value="{{ $d->idrole_user }}"
                            {{ $reservasi->idrole_user == $d->idrole_user ? 'selected' : '' }}>
                            {{ $d->user->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-actions-custom">
                    <button type="submit" class="btn-success-custom">
                        <i class="bi bi-check-circle"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn-secondary-custom">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
