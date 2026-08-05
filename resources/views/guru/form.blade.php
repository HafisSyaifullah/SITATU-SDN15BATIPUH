<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">NIP <span class="text-danger">*</span></label>
        <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
            value="{{ old('nip', $guru->nip ?? '') }}">
        @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama', $guru->nama ?? '') }}">
        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
        <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
            <option value="">-- Pilih --</option>
            <option value="L" {{ old('jenis_kelamin', $guru->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ old('jenis_kelamin', $guru->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror"
            value="{{ old('tempat_lahir', $guru->tempat_lahir ?? '') }}">
        @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
            value="{{ old('tanggal_lahir', isset($guru) && $guru->tanggal_lahir ? $guru->tanggal_lahir->format('Y-m-d') : '') }}">
        @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Jabatan</label>
        <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror"
            value="{{ old('jabatan', $guru->jabatan ?? '') }}" placeholder="Contoh: Guru Kelas / Guru Mapel">
        @error('jabatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">No HP</label>
        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
            value="{{ old('no_hp', $guru->no_hp ?? '') }}">
        @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-8">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2">{{ old('alamat', $guru->alamat ?? '') }}</textarea>
        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="Aktif" {{ old('status', $guru->status ?? 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Nonaktif" {{ old('status', $guru->status ?? '') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>