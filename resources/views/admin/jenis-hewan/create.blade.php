@extends('layouts.app')

@section('title', 'Tambah Jenis Hewan')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Tambah Jenis Hewan</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('jenis-hewan.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="nama_jenis_hewan" class="form-label">Nama Jenis Hewan</label>
                <input type="text" 
                       class="form-control @error('nama_jenis_hewan') is-invalid @enderror" 
                       id="nama_jenis_hewan" 
                       name="nama_jenis_hewan" 
                       value="{{ old('nama_jenis_hewan') }}" 
                       required>
                
                @error('nama_jenis_hewan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('jenis-hewan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection