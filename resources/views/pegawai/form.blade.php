<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">NIP <span class="text-danger">*</span></label>
        <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
            value="{{ old('nip', $pegawai->nip ?? '') }}">
        @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama', $pegawai->nama ?? '') }}">
        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Jabatan</label>
        <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror"
            value="{{ old('jabatan', $pegawai->jabatan ?? '') }}">
        @error('jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">No HP</label>
        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
            value="{{ old('no_hp', $pegawai->no_hp ?? '') }}">
        @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-8">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2">{{ old('alamat', $pegawai->alamat ?? '') }}</textarea>
        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="Aktif" {{ old('status', $pegawai->status ?? 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Nonaktif" {{ old('status', $pegawai->status ?? '') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>