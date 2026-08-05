<div class="d-flex gap-1">
    <a href="{{ Storage::url($item->file_pdf) }}" target="_blank" class="btn btn-sm btn-info" title="Preview">
        <i class="bi bi-eye"></i>
    </a>
    <a href="{{ route('arsip-surat.download', $item->id) }}" class="btn btn-sm btn-primary" title="Download">
        <i class="bi bi-download"></i>
    </a>
</div>
