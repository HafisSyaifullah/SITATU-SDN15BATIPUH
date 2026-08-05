<x-app-layout>
    <x-slot name="title">Data Inventaris</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Data Inventaris Barang</h5>
            <a href="{{ route('inventaris.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Barang
            </a>
        </div>

        <div class="table-responsive">
            <table id="table-inventaris" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                        <th>Lokasi</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function () {
                $('#table-inventaris').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('inventaris.index') }}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'kode_barang', name: 'kode_barang' },
                        { data: 'nama_barang', name: 'nama_barang' },
                        { data: 'kategori', name: 'kategori', orderable: false },
                        { data: 'jumlah', name: 'jumlah' },
                        { data: 'kondisi_badge', name: 'kondisi', orderable: false, searchable: false },
                        { data: 'lokasi', name: 'lokasi' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    language: { search: '', searchPlaceholder: 'Cari inventaris...', emptyTable: 'Belum ada data.', zeroRecords: 'Data tidak ditemukan.' },
                });
            });
        </script>
    @endpush
</x-app-layout>