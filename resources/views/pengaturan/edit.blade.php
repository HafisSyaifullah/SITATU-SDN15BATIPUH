<x-app-layout>
    <x-slot name="title">Pengaturan Sekolah</x-slot>

    <div class="card p-4" style="max-width:700px;">
        <h5 class="fw-semibold mb-3">Pengaturan Identitas Sekolah</h5>

        <form action="{{ route('pengaturan.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-8">
                    <label class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                    <input type="text" name="nama_sekolah" class="form-control @error('nama_sekolah') is-invalid @enderror"
                        value="{{ old('nama_sekolah', $pengaturan->nama_sekolah ?? '') }}">
                    @error('nama_sekolah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-4">
                    <label class="form-label">NPSN</label>
                    <input type="text" name="npsn" class="form-control @error('npsn') is-invalid @enderror"
                        value="{{ old('npsn', $pengaturan->npsn ?? '') }}">
                    @error('npsn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-12">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="2">{{ old('alamat', $pengaturan->alamat ?? '') }}</textarea>
                    @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nama Kepala Sekolah</label>
                    <input type="text" name="kepala_sekolah" class="form-control @error('kepala_sekolah') is-invalid @enderror"
                        value="{{ old('kepala_sekolah', $pengaturan->kepala_sekolah ?? '') }}">
                    @error('kepala_sekolah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Telepon</label>
                    <input type="text" name="telepon" class="form-control @error('telepon') is-invalid @enderror"
                        value="{{ old('telepon', $pengaturan->telepon ?? '') }}">
                    @error('telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', $pengaturan->email ?? '') }}">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Logo Sekolah</label>
                    <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/*">
                    @error('logo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    @if (isset($pengaturan) && $pengaturan->logo)
                        <img src="{{ Storage::url($pengaturan->logo) }}" class="mt-2" width="60" alt="Logo">
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-save me-1"></i> Simpan Pengaturan</button>
        </form>
    </div>
</x-app-layout>