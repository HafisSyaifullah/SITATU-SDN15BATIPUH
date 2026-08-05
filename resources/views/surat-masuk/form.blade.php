<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nomor Surat <span class="text-danger">*</span></label>
        <input type="text" name="nomor_surat" class="form-control @error('nomor_surat') is-invalid @enderror"
            value="{{ old('nomor_surat', $suratMasuk->nomor_surat ?? '') }}">
        @error('nomor_surat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Tanggal Surat <span class="text-danger">*</span></label>
        <input type="date" name="tanggal_surat" class="form-control @error('tanggal_surat') is-invalid @enderror"
            value="{{ old('tanggal_surat', isset($suratMasuk) ? $suratMasuk->tanggal_surat->format('Y-m-d') : '') }}">
        @error('tanggal_surat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Pengirim <span class="text-danger">*</span></label>
        <input type="text" name="pengirim" class="form-control @error('pengirim') is-invalid @enderror"
            value="{{ old('pengirim', $suratMasuk->pengirim ?? '') }}">
        @error('pengirim') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Lampiran</label>
        <input type="text" name="lampiran" class="form-control @error('lampiran') is-invalid @enderror"
            value="{{ old('lampiran', $suratMasuk->lampiran ?? '') }}" placeholder="Contoh: 2 lembar">
        @error('lampiran') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Perihal <span class="text-danger">*</span></label>
        <input type="text" name="perihal" class="form-control @error('perihal') is-invalid @enderror"
            value="{{ old('perihal', $suratMasuk->perihal ?? '') }}">
        @error('perihal') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">File PDF {{ isset($suratMasuk) ? '' : '' }}<span class="text-danger">*</span></label>
        <input type="file" name="file_pdf" class="form-control @error('file_pdf') is-invalid @enderror" accept="application/pdf">
        @error('file_pdf') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if (isset($suratMasuk) && $suratMasuk->file_pdf)
            <small class="text-muted">File saat ini: <a href="{{ Storage::url($suratMasuk->file_pdf) }}" target="_blank">Lihat File</a>. Unggah file baru jika ingin menggantinya.</small>
        @endif
    </div>

    <div class="col-md-12">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="2">{{ old('keterangan', $suratMasuk->keterangan ?? '') }}</textarea>
        @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>