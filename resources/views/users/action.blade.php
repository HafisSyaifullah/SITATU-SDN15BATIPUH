<div class="d-flex gap-1">
    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Edit">
        <i class="bi bi-pencil-square"></i>
    </a>
    @if ($user->id !== auth()->id())
        <form action="{{ route('users.toggle-active', $user->id) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-sm btn-secondary" title="Aktif/Nonaktif">
                <i class="bi bi-toggle2-on"></i>
            </button>
        </form>
        <button type="button" class="btn btn-sm btn-danger btn-delete"
            data-url="{{ route('users.destroy', $user->id) }}" title="Hapus">
            <i class="bi bi-trash"></i>
        </button>
    @endif
</div>
