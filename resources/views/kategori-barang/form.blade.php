<div class="mb-3">
    <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
    <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror"
        value="{{ old('nama_kategori', $kategoriBarang->nama_kategori ?? '') }}">
    @error('nama_kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>