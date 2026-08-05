<x-app-layout>
    <x-slot name="title">Data Alumni</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Data Alumni</h5>
            <a href="{{ route('alumni.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Alumni
            </a>
        </div>

        <div class="table-responsive">
            <table id="table-alumni" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Tahun Lulus</th>
                        <th>Pekerjaan</th>
                        <th>Alamat</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function () {
                $('#table-alumni').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('alumni.index') }}',
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'nama', name: 'nama' },
                        { data: 'tahun_lulus', name: 'tahun_lulus' },
                        { data: 'pekerjaan', name: 'pekerjaan' },
                        { data: 'alamat', name: 'alamat' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    order: [[2, 'desc']],
                    language: { search: '', searchPlaceholder: 'Cari data alumni...', emptyTable: 'Belum ada data alumni.', zeroRecords: 'Data tidak ditemukan.' },
                });
            });
        </script>
    @endpush
</x-app-layout>