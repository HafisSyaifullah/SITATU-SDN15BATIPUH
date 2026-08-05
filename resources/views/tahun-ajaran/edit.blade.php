<x-app-layout>
    <x-slot name="title">Edit Tahun Ajaran</x-slot>

    <div class="card p-4" style="max-width:600px;">
        <h5 class="fw-semibold mb-3">Edit Tahun Ajaran</h5>

        <form action="{{ route('tahun-ajaran.update', $tahunAjaran->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('tahun-ajaran.form', ['tahunAjaran' => $tahunAjaran])

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Perbarui</button>
                <a href="{{ route('tahun-ajaran.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>