<x-app-layout>
    <x-slot name="title">Tambah Role</x-slot>

    <div class="card p-4">
        <h5 class="fw-semibold mb-3">Tambah Role Baru</h5>

        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            @include('roles.form')

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>