<x-app-layout>
    <x-slot name="title">Laporan Inventaris</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h5 class="fw-semibold mb-0">Laporan Data Inventaris</h5>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('laporan.inventaris.pdf') }}" class="btn btn-danger btn-sm">
                    <i class="bi bi-file-pdf me-1"></i> Export PDF
                </a>
                <a href="{{ route('laporan.inventaris.excel') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-file-excel me-1"></i> Export Excel
                </a>
                <button onclick="window.print()" class="btn btn-secondary btn-sm">
                    <i class="bi bi-printer me-1"></i> Print
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                        <th>Lokasi</th>
                        <th>Tahun Pengadaan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($inventaris as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $item->kode_barang ?: '-' }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->kategori?->nama_kategori ?? '-' }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->kondisi ?: '-' }}</td>
                            <td>{{ $item->lokasi ?: '-' }}</td>
                            <td>{{ $item->tahun_pengadaan ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-3">Belum ada data inventaris.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
