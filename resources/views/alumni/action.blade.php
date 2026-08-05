<div class="d-flex gap-1">
    <a href="{{ route('alumni.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
        <i class="bi bi-pencil-square"></i>
    </a>
    <button type="button" class="btn btn-sm btn-danger btn-delete"
        data-url="{{ route('alumni.destroy', $item->id) }}" title="Hapus">
        <i class="bi bi-trash"></i>
    </button>
</div>
