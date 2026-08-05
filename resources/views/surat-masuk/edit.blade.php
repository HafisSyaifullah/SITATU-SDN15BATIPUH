<x-app-layout>
    <x-slot name="title">Edit Surat Masuk</x-slot>

    <div class="card p-4" style="max-width:800px;">
        <h5 class="fw-semibold mb-3">Edit Surat Masuk</h5>

        <form action="{{ route('surat-masuk.update', $suratMasuk->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('surat-masuk.form', ['suratMasuk' => $suratMasuk])

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Perbarui</button>
                <a href="{{ route('surat-masuk.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>