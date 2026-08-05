<x-app-layout>
    <x-slot name="title">Data Guru</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Data Guru</h5>
            <a href="{{ route('guru.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Guru
            </a>
        </div>

        <div class="table-responsive">
            <table id="table-guru" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Jabatan</th>
                        <th>No HP</th>
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
                $('#table-guru').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('guru.index') }}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'nip', name: 'nip' },
                        { data: 'nama', name: 'nama' },
                        { data: 'jenis_kelamin', name: 'jenis_kelamin' },
                        { data: 'jabatan', name: 'jabatan' },
                        { data: 'no_hp', name: 'no_hp' },
                        { data: 'status_badge', name: 'status', orderable: false, searchable: false },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    language: {
                        search: '',
                        searchPlaceholder: 'Cari data guru...',
                        emptyTable: 'Belum ada data guru.',
                        zeroRecords: 'Data tidak ditemukan.',
                    },
                });
            });
        </script>
    @endpush
</x-app-layout>