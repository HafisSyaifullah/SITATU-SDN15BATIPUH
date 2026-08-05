<x-app-layout>
    <x-slot name="title">Edit Role</x-slot>

    <div class="card p-4">
        <h5 class="fw-semibold mb-3">Edit Role: {{ $role->name }}</h5>

        <form action="{{ route('roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')
            @include('roles.form', ['role' => $role])

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Perbarui</button>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>