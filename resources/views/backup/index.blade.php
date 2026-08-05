<x-app-layout>
    <x-slot name="title">Backup Database</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Backup Database</h5>
            <form action="{{ route('backup.create') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="bi bi-database-add me-1"></i> Buat Backup Baru
                </button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama File</th>
                        <th>Ukuran</th>
                        <th>Tanggal Dibuat</th>
                        <th width="130">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($backups as $i => $backup)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $backup['name'] }}</td>
                            <td>{{ number_format($backup['size'] / 1024, 2) }} KB</td>
                            <td>{{ \Carbon\Carbon::createFromTimestamp($backup['date'])->format('d-m-Y H:i') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('backup.download', $backup['name']) }}" class="btn btn-sm btn-primary" title="Download">
                                        <i class="bi bi-download"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger btn-delete"
                                        data-url="{{ route('backup.destroy', $backup['name']) }}" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-3">Belum ada file backup.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>