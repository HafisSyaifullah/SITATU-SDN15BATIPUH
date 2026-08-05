<div class="row g-3">
    <div class="col-md-12">
        <label class="form-label">Judul Agenda <span class="text-danger">*</span></label>
        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
            value="{{ old('judul', $agenda->judul ?? '') }}">
        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Tanggal <span class="text-danger">*</span></label>
        <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
            value="{{ old('tanggal', isset($agenda) ? $agenda->tanggal->format('Y-m-d') : '') }}">
        @error('tanggal') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Jam <span class="text-danger">*</span></label>
        <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror"
            value="{{ old('jam', $agenda->jam ?? '') }}">
        @error('jam') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Tempat</label>
        <input type="text" name="tempat" class="form-control @error('tempat') is-invalid @enderror"
            value="{{ old('tempat', $agenda->tempat ?? '') }}">
        @error('tempat') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-12">
        <label class="form-label">Keterangan</label>
        <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" rows="2">{{ old('keterangan', $agenda->keterangan ?? '') }}</textarea>
        @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
</div>