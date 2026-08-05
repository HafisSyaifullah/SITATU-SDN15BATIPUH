<x-app-layout>
    <x-slot name="title">Tambah Inventaris</x-slot>

    <div class="card p-4" style="max-width:700px;">
        <h5 class="fw-semibold mb-3">Tambah Data Inventaris</h5>

        <form action="{{ route('inventaris.store') }}" method="POST">
            @csrf
            @include('inventaris.form')

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
                <a href="{{ route('inventaris.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>