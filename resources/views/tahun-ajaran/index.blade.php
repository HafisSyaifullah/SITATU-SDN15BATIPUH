<x-app-layout>
    <x-slot name="title">Tahun Ajaran</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Data Tahun Ajaran</h5>
            <a href="{{ route('tahun-ajaran.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Tahun Ajaran
            </a>
        </div>

        <div class="table-responsive">
            <table id="table-tahun-ajaran" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tahun</th>
                        <th>Semester</th>
                        <th>Status</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function () {
                $('#table-tahun-ajaran').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('tahun-ajaran.index') }}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'tahun', name: 'tahun' },
                        { data: 'semester', name: 'semester' },
                        { data: 'status_badge', name: 'status_aktif', orderable: false, searchable: false },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    language: { search: '', searchPlaceholder: 'Cari...', emptyTable: 'Belum ada data.', zeroRecords: 'Data tidak ditemukan.' },
                });
            });
        </script>
    @endpush
</x-app-layout>