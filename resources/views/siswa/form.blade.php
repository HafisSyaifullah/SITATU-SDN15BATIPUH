<div class="row g-3">
    <div class="col-md-4">
        <label class="form-label">NIS <span class="text-danger">*</span></label>
        <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror"
            value="{{ old('nis', $siswa->nis ?? '') }}">
        @error('nis') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">NISN <span class="text-danger">*</span></label>
        <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror"
            value="{{ old('nisn', $siswa->nisn ?? '') }}">
        @error('nisn') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
        <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
            <option value="">-- Pilih --</option>
            <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
            value="{{ old('nama', $siswa->nama ?? '') }}">
        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label">Tempat Lahir</label>
        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror"
            value="{{ old('tempat_lahir', $siswa->tempat_lahir ?? '') }}">
        @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror"
            value="{{ old('tanggal_lahir', isset($siswa) && $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('Y-m-d') : '') }}">
        @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-8">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2">{{ old('alamat', $siswa->alamat ?? '') }}</textarea>
        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Status <span class="text-danger">*</span></label>
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            @foreach (['Aktif', 'Pindah', 'Lulus', 'Keluar'] as $s)
                <option value="{{ $s }}" {{ old('status', $siswa->status ?? 'Aktif') == $s ? 'selected' : '' }}>{{ $s }}</option>
            @endforeach
        </select>
        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Nama Orang Tua</label>
        <input type="text" name="nama_orang_tua" class="form-control @error('nama_orang_tua') is-invalid @enderror"
            value="{{ old('nama_orang_tua', $siswa->nama_orang_tua ?? '') }}">
        @error('nama_orang_tua') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">No HP Orang Tua</label>
        <input type="text" name="no_hp_orang_tua" class="form-control @error('no_hp_orang_tua') is-invalid @enderror"
            value="{{ old('no_hp_orang_tua', $siswa->no_hp_orang_tua ?? '') }}">
        @error('no_hp_orang_tua') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Kelas <span class="text-danger">*</span></label>
        <select name="kelas_id" class="form-select @error('kelas_id') is-invalid @enderror">
            <option value="">-- Pilih Kelas --</option>
            @foreach ($kelas as $id => $namaKelas)
                <option value="{{ $id }}" {{ old('kelas_id', $siswa->kelas_id ?? '') == $id ? 'selected' : '' }}>{{ $namaKelas }}</option>
            @endforeach
        </select>
        @error('kelas_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Tahun Ajaran <span class="text-danger">*</span></label>
        <select name="tahun_ajaran_id" class="form-select @error('tahun_ajaran_id') is-invalid @enderror">
            <option value="">-- Pilih Tahun Ajaran --</option>
            @foreach ($tahunAjaran as $ta)
                <option value="{{ $ta->id }}" {{ old('tahun_ajaran_id', $siswa->tahun_ajaran_id ?? '') == $ta->id ? 'selected' : '' }}>
                    {{ $ta->tahun }} ({{ $ta->semester }})
                </option>
            @endforeach
        </select>
        @error('tahun_ajaran_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>