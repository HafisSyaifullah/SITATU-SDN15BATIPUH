<x-app-layout>
    <x-slot name="title">Edit Kategori Barang</x-slot>

    <div class="card p-4" style="max-width:500px;">
        <h5 class="fw-semibold mb-3">Edit Kategori Barang</h5>

        <form action="{{ route('kategori-barang.update', $kategoriBarang->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('kategori-barang.form', ['kategoriBarang' => $kategoriBarang])

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Perbarui</button>
                <a href="{{ route('kategori-barang.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>