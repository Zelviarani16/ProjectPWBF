<form action="{{ route('admin.pemilik.store') }}" method="POST">
    @csrf

    {{-- Pilih User --}}
    <div class="mb-3">
        <label for="iduser" class="form-label">User Terkait</label>
        <select name="iduser" id="iduser" class="form-select @error('iduser') is-invalid @enderror" required>
            <option value="">-- Pilih User --</option>
            @foreach($users as $user)
                <option value="{{ $user->iduser }}" {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
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
        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat') }}</textarea>
        @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- No WA --}}
    <div class="mb-3">
        <label for="no_wa" class="form-label">No WhatsApp</label>
        <input type="text" name="no_wa" id="no_wa" class="form-control @error('no_wa') is-invalid @enderror" value="{{ old('no_wa') }}" required>
        @error('no_wa')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">Batal</a>
</form>
