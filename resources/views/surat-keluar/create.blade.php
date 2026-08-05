<x-app-layout>
    <x-slot name="title">Tambah Surat Keluar</x-slot>

    <div class="card p-4" style="max-width:800px;">
        <h5 class="fw-semibold mb-3">Tambah Surat Keluar</h5>

        <form action="{{ route('surat-keluar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('surat-keluar.form')

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
                <a href="{{ route('surat-keluar.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>