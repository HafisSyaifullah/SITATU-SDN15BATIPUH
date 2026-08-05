<div class="mb-3" style="max-width:400px;">
    <label class="form-label">Nama Role <span class="text-danger">*</span></label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $role->name ?? '') }}"
        {{ isset($role) && in_array($role->name, ['Admin', 'Petugas Tata Usaha', 'Kepala Sekolah']) ? 'readonly' : '' }}>
    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>

<label class="form-label fw-semibold">Hak Akses (Permission)</label>
<div class="row g-3">
    @foreach ($permissions as $group => $items)
        <div class="col-md-4">
            <div class="card p-3 h-100">
                <h6 class="text-capitalize fw-semibold" style="font-size:.85rem">{{ str_replace('-', ' ', $group) }}</h6>
                @foreach ($items as $permission)
                    <div class="form-check">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                            class="form-check-input" id="perm-{{ $permission->id }}"
                            {{ in_array($permission->name, old('permissions', $rolePermissions ?? [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="perm-{{ $permission->id }}" style="font-size:.83rem">
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>