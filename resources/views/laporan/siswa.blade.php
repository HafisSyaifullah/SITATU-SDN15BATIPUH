<x-app-layout>
    <x-slot name="title">Laporan Siswa</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h5 class="fw-semibold mb-0">Laporan Data Siswa</h5>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('laporan.siswa.pdf', request()->query()) }}" class="btn btn-danger btn-sm">
                    <i class="bi bi-file-pdf me-1"></i> Export PDF
                </a>
                <a href="{{ route('laporan.siswa.excel') }}" class="btn btn-success btn-sm">
                    <i class="bi bi-file-excel me-1"></i> Export Excel
                </a>
                <button onclick="window.print()" class="btn btn-secondary btn-sm">
                    <i class="bi bi-printer me-1"></i> Print
                </button>
            </div>
        </div>

        <form method="GET" action="{{ route('laporan.siswa') }}" class="row g-2 align-items-end mb-3">
            <div class="col-md-4">
                <label class="form-label">Filter Kelas</label>
                <select name="kelas_id" class="form-select">
                    <option value="">Semua Kelas</option>
                    @foreach ($kelasList as $id => $nama)
                        <option value="{{ $id }}" {{ request('kelas_id') == $id ? 'selected' : '' }}>
                            {{ $nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm w-100">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('laporan.siswa') }}" class="btn btn-outline-secondary btn-sm w-100">
                    Reset
                </a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>NISN</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Tahun Ajaran</th>
                        <th>Jenis Kelamin</th>
                        <th>Nama Orang Tua</th>
                        <th>No HP Ortu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswa as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $item->nis ?: '-' }}</td>
                            <td>{{ $item->nisn ?: '-' }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->kelas?->nama_kelas ?? '-' }}</td>
                            <td>{{ $item->tahunAjaran?->tahun ?? '-' }}</td>
                            <td>{{ $item->jenis_kelamin ?: '-' }}</td>
                            <td>{{ $item->nama_orang_tua ?: '-' }}</td>
                            <td>{{ $item->no_hp_orang_tua ?: '-' }}</td>
                            <td>{{ $item->status ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-3">Belum ada data siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
