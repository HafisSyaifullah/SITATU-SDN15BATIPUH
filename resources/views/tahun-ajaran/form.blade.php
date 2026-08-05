<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Tahun Ajaran <span class="text-danger">*</span></label>
        <input type="text" name="tahun" class="form-control @error('tahun') is-invalid @enderror"
            value="{{ old('tahun', $tahunAjaran->tahun ?? '') }}" placeholder="Contoh: 2025/2026">
        @error('tahun') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Semester <span class="text-danger">*</span></label>
        <select name="semester" class="form-select @error('semester') is-invalid @enderror">
            <option value="Ganjil" {{ old('semester', $tahunAjaran->semester ?? '') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
            <option value="Genap" {{ old('semester', $tahunAjaran->semester ?? '') == 'Genap' ? 'selected' : '' }}>Genap</option>
        </select>
        @error('semester') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <div class="form-check">
            <input type="checkbox" name="status_aktif" value="1" class="form-check-input" id="statusAktif"
                {{ old('status_aktif', $tahunAjaran->status_aktif ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="statusAktif">Jadikan Tahun Ajaran Aktif</label>
        </div>
        <small class="text-muted">Mengaktifkan tahun ajaran ini akan menonaktifkan tahun ajaran lain secara otomatis.</small>
    </div>
</div>