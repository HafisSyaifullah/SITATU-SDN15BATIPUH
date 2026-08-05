<x-app-layout>
    <x-slot name="title">Tambah Alumni</x-slot>

    <div class="card p-4" style="max-width:700px;">
        <h5 class="fw-semibold mb-3">Tambah Data Alumni</h5>

        <form action="{{ route('alumni.store') }}" method="POST">
            @csrf
            @include('alumni.form')

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
                <a href="{{ route('alumni.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>