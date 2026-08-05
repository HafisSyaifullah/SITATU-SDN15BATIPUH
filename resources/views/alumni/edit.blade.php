<x-app-layout>
    <x-slot name="title">Edit Alumni</x-slot>

    <div class="card p-4" style="max-width:700px;">
        <h5 class="fw-semibold mb-3">Edit Data Alumni</h5>

        <form action="{{ route('alumni.update', $alumni->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('alumni.form', ['alumni' => $alumni])

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Perbarui</button>
                <a href="{{ route('alumni.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>