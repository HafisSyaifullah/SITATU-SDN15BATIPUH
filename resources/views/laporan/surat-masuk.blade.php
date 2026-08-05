<x-app-layout>
    <x-slot name="title">Laporan Surat Masuk</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h5 class="fw-semibold mb-0">Laporan Surat Masuk</h5>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('laporan.surat-masuk.pdf', request()->query()) }}" class="btn btn-danger btn-sm">
                    <i class="bi bi-file-pdf me-1"></i> Export PDF
                </a>
                <a href="{{ route('laporan.surat-masuk.excel', request()->query()) }}" class="btn btn-success btn-sm">
                    <i class="bi bi-file-excel me-1"></i> Export Excel
                </a>
                <button onclick="window.print()" class="btn btn-secondary btn-sm">
                    <i class="bi bi-printer me-1"></i> Print
                </button>
            </div>
        </div>

        <form method="GET" action="{{ route('laporan.surat-masuk') }}" class="row g-2 align-items-end mb-3">
            <div class="col-md-3">
                <label class="form-label">Dari Tanggal</label>
                <input type="date" name="dari" class="form-control" value="{{ request('dari') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control" value="{{ request('sampai') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('laporan.surat-masuk') }}" class="btn btn-outline-secondary btn-sm w-100">
                    Reset
                </a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nomor Surat</th>
                        <th>Tanggal</th>
                        <th>Pengirim</th>
                        <th>Perihal</th>
                        <th>Lampiran</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suratMasuk as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $item->nomor_surat }}</td>
                            <td>{{ $item->tanggal_surat?->format('d-m-Y') ?? '-' }}</td>
                            <td>{{ $item->pengirim }}</td>
                            <td>{{ $item->perihal }}</td>
                            <td>{{ $item->lampiran ?: '-' }}</td>
                            <td>{{ $item->keterangan ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">Belum ada data surat masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
