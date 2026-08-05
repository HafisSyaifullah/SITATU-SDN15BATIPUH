<x-app-layout>
    <x-slot name="title">Tambah Mutasi Siswa</x-slot>

    <div class="card p-4" style="max-width:700px;">
        <h5 class="fw-semibold mb-3">Tambah Data Mutasi Siswa</h5>

        <form action="{{ route('mutasi-siswa.store') }}" method="POST">
            @csrf
            @include('mutasi-siswa.form')

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
                <a href="{{ route('mutasi-siswa.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>