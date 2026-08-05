<x-app-layout>
    <x-slot name="title">Edit Siswa</x-slot>

    <div class="card p-4" style="max-width:900px;">
        <h5 class="fw-semibold mb-3">Edit Data Siswa</h5>

        <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('siswa.form', ['siswa' => $siswa])

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Perbarui</button>
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>