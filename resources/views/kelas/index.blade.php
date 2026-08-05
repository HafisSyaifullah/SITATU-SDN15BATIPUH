<x-app-layout>
    <x-slot name="title">Data Kelas</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Data Kelas</h5>
            <a href="{{ route('kelas.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Kelas
            </a>
        </div>

        <div class="table-responsive">
            <table id="table-kelas" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Kelas</th>
                        <th>Tingkat</th>
                        <th>Wali Kelas</th>
                        <th>Jumlah Siswa</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function () {
                $('#table-kelas').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('kelas.index') }}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'nama_kelas', name: 'nama_kelas' },
                        { data: 'tingkat', name: 'tingkat' },
                        { data: 'wali_kelas', name: 'wali_kelas' },
                        { data: 'siswa_count', name: 'siswa_count', orderable: false },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    language: { search: '', searchPlaceholder: 'Cari data kelas...', emptyTable: 'Belum ada data kelas.', zeroRecords: 'Data tidak ditemukan.' },
                });
            });
        </script>
    @endpush
</x-app-layout>