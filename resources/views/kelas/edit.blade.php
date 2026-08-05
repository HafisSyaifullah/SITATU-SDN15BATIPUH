<x-app-layout>
    <x-slot name="title">Edit Kelas</x-slot>

    <div class="card p-4" style="max-width:600px;">
        <h5 class="fw-semibold mb-3">Edit Data Kelas</h5>

        <form action="{{ route('kelas.update', ['kelas' => $kelas->id]) }}" method="POST">
            @csrf
            @method('PUT')
            @include('kelas.form', ['kelas' => $kelas])

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Perbarui</button>
                <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>