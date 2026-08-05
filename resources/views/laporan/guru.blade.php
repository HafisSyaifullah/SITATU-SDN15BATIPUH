<x-app-layout>
    <x-slot name="title">Laporan Guru</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h5 class="fw-semibold mb-0">Laporan Data Guru</h5>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('laporan.guru.pdf') }}" class="btn btn-danger btn-sm">
                    <i class="bi bi-file-pdf me-1"></i> Export PDF
                </a>
                <a href="{{ route('laporan.guru.excel') }}" class="btn btn-success btn-sm">
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
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Jabatan</th>
                        <th>No HP</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($guru as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $item->nip ?: '-' }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>
                                @if ($item->jenis_kelamin === 'L')
                                    Laki-laki
                                @elseif ($item->jenis_kelamin === 'P')
                                    Perempuan
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $item->tempat_lahir ?: '-' }}</td>
                            <td>{{ $item->tanggal_lahir ? $item->tanggal_lahir->format('d-m-Y') : '-' }}</td>
                            <td>{{ $item->jabatan ?: '-' }}</td>
                            <td>{{ $item->no_hp ?: '-' }}</td>
                            <td>
                                @if ($item->status)
                                    <span class="badge bg-success">{{ $item->status }}</span>
                                @else
                                    <span class="badge bg-secondary">-</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-3">Belum ada data guru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
