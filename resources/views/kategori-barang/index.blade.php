<x-app-layout>
    <x-slot name="title">Kategori Barang</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Data Kategori Barang</h5>
            <a href="{{ route('kategori-barang.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
            </a>
        </div>

        <div class="table-responsive">
            <table id="table-kategori" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kategori</th>
                        <th>Jumlah Barang</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function () {
                $('#table-kategori').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('kategori-barang.index') }}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'nama_kategori', name: 'nama_kategori' },
                        { data: 'inventaris_count', name: 'inventaris_count', orderable: false },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    language: { search: '', searchPlaceholder: 'Cari kategori...', emptyTable: 'Belum ada data.', zeroRecords: 'Data tidak ditemukan.' },
                });
            });
        </script>
    @endpush
</x-app-layout>