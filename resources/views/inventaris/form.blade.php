<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Kode Barang <span class="text-danger">*</span></label>
        <input type="text" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror"
            value="{{ old('kode_barang', $inventaris->kode_barang ?? '') }}">
        @error('kode_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Nama Barang <span class="text-danger">*</span></label>
        <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror"
            value="{{ old('nama_barang', $inventaris->nama_barang ?? '') }}">
        @error('nama_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Kategori <span class="text-danger">*</span></label>
        <select name="kategori_barang_id" class="form-select @error('kategori_barang_id') is-invalid @enderror">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($kategori as $id => $nama)
                <option value="{{ $id }}" {{ old('kategori_barang_id', $inventaris->kategori_barang_id ?? '') == $id ? 'selected' : '' }}>{{ $nama }}</option>
            @endforeach
        </select>
        @error('kategori_barang_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Jumlah <span class="text-danger">*</span></label>
        <input type="number" min="0" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
            value="{{ old('jumlah', $inventaris->jumlah ?? 0) }}">
        @error('jumlah') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Kondisi <span class="text-danger">*</span></label>
        <select name="kondisi" class="form-select @error('kondisi') is-invalid @enderror">
            @foreach (['Baik', 'Rusak Ringan', 'Rusak Berat'] as $k)
                <option value="{{ $k }}" {{ old('kondisi', $inventaris->kondisi ?? 'Baik') == $k ? 'selected' : '' }}>{{ $k }}</option>
            @endforeach
        </select>
        @error('kondisi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Lokasi</label>
        <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
            value="{{ old('lokasi', $inventaris->lokasi ?? '') }}" placeholder="Contoh: Ruang Kelas I A">
        @error('lokasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Tahun Pengadaan</label>
        <input type="text" name="tahun_pengadaan" class="form-control @error('tahun_pengadaan') is-invalid @enderror"
            value="{{ old('tahun_pengadaan', $inventaris->tahun_pengadaan ?? '') }}" maxlength="4" placeholder="Contoh: 2024">
        @error('tahun_pengadaan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>