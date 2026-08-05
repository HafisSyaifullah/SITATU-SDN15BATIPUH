<x-app-layout>
    <x-slot name="title">Hak Akses</x-slot>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-semibold mb-0">Kelola Role & Hak Akses</h5>
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i> Tambah Role
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Role</th>
                        <th>Jumlah Permission</th>
                        <th width="130">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $i => $role)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $role->name }}</td>
                            <td><span class="badge bg-primary">{{ $role->permissions_count }} permission</span></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    @unless (in_array($role->name, ['Admin', 'Petugas Tata Usaha', 'Kepala Sekolah']))
                                        <button type="button" class="btn btn-sm btn-danger btn-delete"
                                            data-url="{{ route('roles.destroy', $role->id) }}" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    @endunless
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted py-3">Belum ada role.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>