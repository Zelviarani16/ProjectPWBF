@extends('layouts.lte.main')

@section('title', 'Tambah Role ke User')
@section('page-title', 'Tambah Role ke User')

@section('content')

<!-- App Content Header -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Tambah Role ke User</h3>
                <p class="text-muted">Form untuk menambahkan role baru ke user</p>
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

                <!-- Card -->
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="bi bi-shield-plus"></i> Form Tambah Role
                        </h3>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('admin.user-role.store') }}" method="POST">
                            @csrf

                            {{-- User --}}
                            <div class="mb-3">
                                <label for="iduser" class="form-label">User</label>
                                <select 
                                    id="iduser" 
                                    name="iduser" 
                                    class="form-control @error('iduser') is-invalid @enderror"
                                    required
                                >
                                    <option value="">-- Pilih User --</option>
                                    @foreach($users as $u)
                                        <option 
                                            value="{{ $u->iduser }}"
                                            {{ old('iduser') == $u->iduser ? 'selected' : '' }}
                                        >
                                            {{ $u->nama }} ({{ $u->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('iduser')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Role --}}
                            <div class="mb-3">
                                <label for="idrole" class="form-label">Role</label>
                                <select 
                                    id="idrole" 
                                    name="idrole" 
                                    class="form-control @error('idrole') is-invalid @enderror"
                                    required
                                >
                                    <option value="">-- Pilih Role --</option>
                                    @foreach($roles as $r)
                                        <option 
                                            value="{{ $r->idrole }}"
                                            {{ old('idrole') == $r->idrole ? 'selected' : '' }}
                                        >
                                            {{ $r->nama_role }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idrole')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="mb-4">
                                <label for="status" class="form-label">Status</label>
                                <select 
                                    id="status" 
                                    name="status" 
                                    class="form-control"
                                >
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                            </div>

                            {{-- Buttons --}}
                            <div class="d-flex justify-content-end gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-save"></i> Simpan Role
                                </button>

                                <a href="{{ route('admin.user-role.index') }}" class="btn btn-secondary">
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
