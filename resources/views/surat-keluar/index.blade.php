<x-app-layout>
    <x-slot name="title">Surat Keluar</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Data Surat Keluar</h5>
            <a href="{{ route('surat-keluar.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Surat Keluar
            </a>
        </div>

        <div class="table-responsive">
            <table id="table-surat-keluar" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No. Surat</th>
                        <th>Tanggal</th>
                        <th>Tujuan</th>
                        <th>Perihal</th>
                        <th>Diinput Oleh</th>
                        <th width="130">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function () {
                $('#table-surat-keluar').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('surat-keluar.index') }}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'nomor_surat', name: 'nomor_surat' },
                        { data: 'tanggal_format', name: 'tanggal_surat' },
                        { data: 'tujuan', name: 'tujuan' },
                        { data: 'perihal', name: 'perihal' },
                        { data: 'user', name: 'user', orderable: false },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    order: [[2, 'desc']],
                    language: { search: '', searchPlaceholder: 'Cari surat keluar...', emptyTable: 'Belum ada data.', zeroRecords: 'Data tidak ditemukan.' },
                });
            });
        </script>
    @endpush
</x-app-layout>