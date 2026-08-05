<x-app-layout>
    <x-slot name="title">Tambah Siswa</x-slot>

    <div class="card p-4" style="max-width:900px;">
        <h5 class="fw-semibold mb-3">Tambah Data Siswa</h5>

        <form action="{{ route('siswa.store') }}" method="POST">
            @csrf
            @include('siswa.form')

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>