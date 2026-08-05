<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nomor Surat <span class="text-danger">*</span></label>
        <input type="text" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror"
            value="{{ old('nomor_surat', $suratKeluar->nomor_surat ?? '') }}">
        @error('nomor_surat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
        <input type="date" name="tanggal_surat" class="form-control @error('tanggal_surat') is-invalid @enderror"
            value="{{ old('tanggal_surat', isset($suratKeluar) ? $suratKeluar->tanggal_surat->format('Y-m-d') : '') }}">
        @error('tanggal_surat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Tujuan <span class="text-danger">*</span></label>
        <input type="text" name="tujuan" class="form-control @error('tujuan') is-invalid @enderror"
            value="{{ old('tujuan', $suratKeluar->tujuan ?? '') }}">
        @error('tujuan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Penandatangan</label>
        <input type="text" name="penandatangan" class="form-control @error('penandatangan') is-invalid @enderror"
            value="{{ old('penandatangan', $suratKeluar->penandatangan ?? '') }}">
        @error('penandatangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Lampiran</label>
        <input type="text" name="lampiran" class="form-control @error('lampiran') is-invalid @enderror"
            value="{{ old('lampiran', $suratKeluar->lampiran ?? '') }}" placeholder="Contoh: 1 lembar">
        @error('lampiran') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Perihal <span class="text-danger">*</span></label>
        <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror"
            value="{{ old('perihal', $suratKeluar->perihal ?? '') }}">
        @error('perihal') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">File PDF <span class="text-danger">*</span></label>
        <input type="file" name="file_pdf" class="form-control @error('file_pdf') is-invalid @enderror" accept="application/pdf">
        @error('file_pdf') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if (isset($suratKeluar) && $suratKeluar->file_pdf)
            <small class="text-muted">File saat ini: <a href="{{ Storage::url($suratKeluar->file_pdf) }}" target="_blank">Lihat File</a>. Unggah file baru jika ingin menggantinya.</small>
        @endif
    </div>
</div>