<x-app-layout>
    <x-slot name="title">Edit Guru</x-slot>

    <div class="card p-4" style="max-width:800px;">
        <h5 class="fw-semibold mb-3">Edit Data Guru</h5>

        <form action="{{ route('guru.update', $guru->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('guru.form', ['guru' => $guru])

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Perbarui</button>
                <a href="{{ route('guru.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>