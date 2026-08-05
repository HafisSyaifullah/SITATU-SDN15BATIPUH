<x-app-layout>
    <x-slot name="title">Tambah Kelas</x-slot>

    <div class="card p-4" style="max-width:600px;">
        <h5 class="fw-semibold mb-3">Tambah Data Kelas</h5>

        <form action="{{ route('kelas.store') }}" method="POST">
            @csrf
            @include('kelas.form')

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
                <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>