<x-app-layout>
    <x-slot name="title">Tambah Kategori Barang</x-slot>

    <div class="card p-4" style="max-width:500px;">
        <h5 class="fw-semibold mb-3">Tambah Kategori Barang</h5>

        <form action="{{ route('kategori-barang.store') }}" method="POST">
            @csrf
            @include('kategori-barang.form')

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan</button>
                <a href="{{ route('kategori-barang.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>