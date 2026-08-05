<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label">Terkait Data Siswa (opsional)</label>
        <select name="siswa_id" class="form-select @error('siswa_id') is-invalid @enderror">
            <option value="">-- Tidak Terkait / Input Manual --</option>
            @foreach ($siswa as $id => $nama)
                <option value="{{ $id }}" {{ old('siswa_id', $alumni->siswa_id ?? '') == $id ? 'selected' : '' }}>{{ $nama }}</option>
            @endforeach
        </select>
        @error('siswa_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        <small class="text-muted">Jika dipilih, status siswa otomatis berubah menjadi "Lulus".</small>
    </div>

    <div class="col-md-6">
        <label class="form-label">Nama Alumni <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama', $alumni->nama ?? '') }}">
        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Tahun Lulus <span class="text-danger">*</span></label>
        <input type="text" name="tahun_lulus" class="form-control @error('tahun_lulus') is-invalid @enderror"
            value="{{ old('tahun_lulus', $alumni->tahun_lulus ?? '') }}" placeholder="Contoh: 2025" maxlength="4">
        @error('tahun_lulus') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Pekerjaan</label>
        <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror"
            value="{{ old('pekerjaan', $alumni->pekerjaan ?? '') }}">
        @error('pekerjaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2">{{ old('alamat', $alumni->alamat ?? '') }}</textarea>
        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>