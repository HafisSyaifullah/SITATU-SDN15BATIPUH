<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $user->name ?? '') }}">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email', $user->email ?? '') }}">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Password {{ isset($user) ? '(kosongkan jika tidak diubah)' : '' }} <span class="text-danger">{{ isset($user) ? '' : '*' }}</span></label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Role <span class="text-danger">*</span></label>
        <select name="role" class="form-select @error('role') is-invalid @enderror">
            <option value="">-- Pilih Role --</option>
            @foreach ($roles as $roleName)
                <option value="{{ $roleName }}"
                    {{ old('role', $user->roles->pluck('name')->first() ?? '') == $roleName ? 'selected' : '' }}>
                    {{ $roleName }}
                </option>
            @endforeach
        </select>
        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Foto Profil</label>
        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
        @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
        @if (isset($user) && $user->foto)
            <img src="{{ Storage::url($user->foto) }}" class="rounded mt-2" width="60" alt="Foto">
        @endif
    </div>

    <div class="col-md-6 d-flex align-items-end">
        <div class="form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="isActive"
                {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="isActive">Akun Aktif</label>
        </div>
    </div>
</div>