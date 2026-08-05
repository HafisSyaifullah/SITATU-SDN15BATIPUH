<x-app-layout>
    <x-slot name="title">Arsip Surat</x-slot>

    <div class="card p-3">
        <h5 class="fw-semibold mb-3">Arsip Surat Masuk & Keluar</h5>

        <div class="row g-2 mb-3">
            <div class="col-md-3">
                <select id="filterJenis" class="form-select form-select-sm">
                    <option value="">Semua Jenis</option>
                    <option value="masuk">Surat Masuk</option>
                    <option value="keluar">Surat Keluar</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" id="filterDari" class="form-control form-control-sm" placeholder="Dari tanggal">
            </div>
            <div class="col-md-3">
                <input type="date" id="filterSampai" class="form-control form-control-sm" placeholder="Sampai tanggal">
            </div>
            <div class="col-md-3">
                <button type="button" id="btnFilter" class="btn btn-primary btn-sm w-100">
                    <i class="bi bi-funnel me-1"></i> Terapkan Filter
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="table-arsip" class="table table-hover align-middle w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Jenis</th>
                        <th>No. Surat</th>
                        <th>Tanggal</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @push('scripts')
        <script>
            $(function () {
                const table = $('#table-arsip').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('arsip-surat.index') }}',
                        data: function (d) {
                            d.jenis_surat = $('#filterJenis').val();
                            d.tanggal_dari = $('#filterDari').val();
                            d.tanggal_sampai = $('#filterSampai').val();
                        },
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'jenis_badge', name: 'jenis_surat', orderable: false, searchable: false },
                        { data: 'nomor_surat', name: 'nomor_surat' },
                        { data: 'tanggal_format', name: 'tanggal_surat' },
                        { data: 'action', name: 'action', orderable: false, searchable: false },
                    ],
                    order: [[3, 'desc']],
                    language: { search: '', searchPlaceholder: 'Cari arsip surat...', emptyTable: 'Belum ada arsip.', zeroRecords: 'Data tidak ditemukan.' },
                });

                $('#btnFilter').on('click', function () {
                    table.ajax.reload();
                });
            });
        </script>
    @endpush
</x-app-layout>