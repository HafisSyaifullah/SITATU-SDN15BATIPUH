<x-app-layout>
    <x-slot name="title">Tambah Tahun Ajaran</x-slot>

    <div class="card p-4" style="max-width:600px;">
        <h5 class="fw-semibold mb-3">Tambah Tahun Ajaran</h5>

        <form action="{{ route('tahun-ajaran.store') }}" method="POST">
            @csrf
            @include('tahun-ajaran.form')

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
                <a href="{{ route('tahun-ajaran.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>