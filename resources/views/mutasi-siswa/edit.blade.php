<x-app-layout>
    <x-slot name="title">Edit Mutasi Siswa</x-slot>

    <div class="card p-4" style="max-width:700px;">
        <h5 class="fw-semibold mb-3">Edit Data Mutasi Siswa</h5>

        <form action="{{ route('mutasi-siswa.update', $mutasiSiswa->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('mutasi-siswa.form', ['mutasiSiswa' => $mutasiSiswa])

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Perbarui</button>
                <a href="{{ route('mutasi-siswa.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>