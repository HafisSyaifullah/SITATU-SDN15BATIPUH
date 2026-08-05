<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nama Kelas <span class="text-danger">*</span></label>
        <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror"
            value="{{ old('nama_kelas', $kelas->nama_kelas ?? '') }}" placeholder="Contoh: I A">
        @error('nama_kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Tingkat <span class="text-danger">*</span></label>
        <select name="tingkat" class="form-select @error('tingkat') is-invalid @enderror">
            <option value="">-- Pilih Tingkat --</option>
            @foreach (range(1, 6) as $t)
                <option value="{{ $t }}" {{ old('tingkat', $kelas->tingkat ?? '') == $t ? 'selected' : '' }}>Kelas {{ $t }}</option>
            @endforeach
        </select>
        @error('tingkat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Wali Kelas</label>
        <input type="text" name="wali_kelas" class="form-control @error('wali_kelas') is-invalid @enderror"
            value="{{ old('wali_kelas', $kelas->wali_kelas ?? '') }}">
        @error('wali_kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>