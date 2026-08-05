<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label">Siswa <span class="text-danger">*</span></label>
        <select name="siswa_id" class="form-select @error('siswa_id') is-invalid @enderror">
            <option value="">-- Pilih Siswa --</option>
            @foreach ($siswa as $id => $nama)
                <option value="{{ $id }}" {{ old('siswa_id', $mutasiSiswa->siswa_id ?? '') == $id ? 'selected' : '' }}>{{ $nama }}</option>
            @endforeach
        </select>
        @error('siswa_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Jenis Mutasi <span class="text-danger">*</span></label>
        <select name="jenis_mutasi" class="form-select @error('jenis_mutasi') is-invalid @enderror">
            <option value="Masuk" {{ old('jenis_mutasi', $mutasiSiswa->jenis_mutasi ?? '') == 'Masuk' ? 'selected' : '' }}>Masuk</option>
            <option value="Keluar" {{ old('jenis_mutasi', $mutasiSiswa->jenis_mutasi ?? '') == 'Keluar' ? 'selected' : '' }}>Keluar</option>
        </select>
        @error('jenis_mutasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Tanggal <span class="text-danger">*</span></label>
        <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
            value="{{ old('tanggal', isset($mutasiSiswa) ? $mutasiSiswa->tanggal->format('Y-m-d') : '') }}">
        @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Sekolah Tujuan</label>
        <input type="text" name="sekolah_tujuan" class="form-control @error('sekolah_tujuan') is-invalid @enderror"
            value="{{ old('sekolah_tujuan', $mutasiSiswa->sekolah_tujuan ?? '') }}">
        @error('sekolah_tujuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="2">{{ old('keterangan', $mutasiSiswa->keterangan ?? '') }}</textarea>
        @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>