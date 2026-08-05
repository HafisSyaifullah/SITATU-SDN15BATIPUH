<div class="d-flex gap-1">
    <a href="{{ route('surat-masuk.preview', $item->id) }}" target="_blank" class="btn btn-sm btn-info" title="Preview">
        <i class="bi bi-eye"></i>
    </a>
    <a href="{{ route('surat-masuk.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
        <i class="bi bi-pencil-square"></i>
    </a>
    <button type="button" class="btn btn-sm btn-danger btn-delete"
        data-url="{{ route('surat-masuk.destroy', $item->id) }}" title="Hapus">
        <i class="bi bi-trash"></i>
    </button>
</div>
