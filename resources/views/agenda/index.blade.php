<x-app-layout>
    <x-slot name="title">Agenda Sekolah</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Data Agenda Sekolah</h5>
            <a href="{{ route('agenda.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Agenda
            </a>
        </div>

        <div class="table-responsive">
            <table id="table-agenda" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Jam</th>
                        <th>Tempat</th>
                        <th>Dibuat Oleh</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function () {
                $('#table-agenda').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('agenda.index') }}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'judul', name: 'judul' },
                        { data: 'tanggal_format', name: 'tanggal' },
                        { data: 'jam', name: 'jam' },
                        { data: 'tempat', name: 'tempat' },
                        { data: 'user', name: 'user', orderable: false },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    order: [[2, 'asc']],
                    language: { search: '', searchPlaceholder: 'Cari agenda...', emptyTable: 'Belum ada agenda.', zeroRecords: 'Data tidak ditemukan.' },
                });
            });
        </script>
    @endpush
</x-app-layout>