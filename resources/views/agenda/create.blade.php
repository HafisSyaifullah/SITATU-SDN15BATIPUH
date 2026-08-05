<x-app-layout>
    <x-slot name="title">Tambah Agenda</x-slot>

    <div class="card p-4" style="max-width:700px;">
        <h5 class="fw-semibold mb-3">Tambah Agenda Sekolah</h5>

        <form action="{{ route('agenda.store') }}" method="POST">
            @csrf
            @include('agenda.form')

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
                <a href="{{ route('agenda.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>