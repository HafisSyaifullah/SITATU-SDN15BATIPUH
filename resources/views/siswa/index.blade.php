<x-app-layout>
    <x-slot name="title">Data Siswa</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Data Siswa</h5>
            <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Siswa
            </a>
        </div>

        <div class="table-responsive">
            <table id="table-siswa" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
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
                $('#table-siswa').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('siswa.index') }}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'nis', name: 'nis' },
                        { data: 'nisn', name: 'nisn' },
                        { data: 'nama', name: 'nama' },
                        { data: 'kelas', name: 'kelas', orderable: false },
                        { data: 'tahun_ajaran', name: 'tahun_ajaran', orderable: false },
                        { data: 'status_badge', name: 'status', orderable: false, searchable: false },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    language: { search: '', searchPlaceholder: 'Cari data siswa...', emptyTable: 'Belum ada data siswa.', zeroRecords: 'Data tidak ditemukan.' },
                });
            });
        </script>
    @endpush
</x-app-layout>