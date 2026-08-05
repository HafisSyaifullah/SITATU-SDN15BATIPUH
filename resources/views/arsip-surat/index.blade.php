<x-app-layout>
    <x-slot name="title">Mutasi Siswa</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Data Mutasi Siswa</h5>
            <a href="{{ route('mutasi-siswa.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Mutasi
            </a>
        </div>

        <div class="table-responsive">
            <table id="table-mutasi" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Mutasi</th>
                        <th>Tanggal</th>
                        <th>Sekolah Tujuan</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function () {
                $('#table-mutasi').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('mutasi-siswa.index') }}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'nis_siswa', name: 'siswa.nis', orderable: false },
                        { data: 'nama_siswa', name: 'siswa.nama', orderable: false },
                        { data: 'jenis_badge', name: 'jenis_mutasi', orderable: false, searchable: false },
                        { data: 'tanggal_format', name: 'tanggal' },
                        { data: 'sekolah_tujuan', name: 'sekolah_tujuan' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    order: [[4, 'desc']],
                    language: { search: '', searchPlaceholder: 'Cari data mutasi...', emptyTable: 'Belum ada data.', zeroRecords: 'Data tidak ditemukan.' },
                });
            });
        </script>
    @endpush
</x-app-layout>