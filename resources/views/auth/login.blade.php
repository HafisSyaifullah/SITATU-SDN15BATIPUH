<x-guest-layout>
    <div class="text-center mb-4">
        <i class="bi bi-mortarboard-fill text-primary" style="font-size:2.5rem;"></i>
        <h4 class="fw-bold mt-2 mb-0">SITU SDN 15 Batipuh</h4>
        <p class="text-muted" style="font-size:.85rem;">Sistem Informasi Tata Usaha Sekolah</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror" required autofocus>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input id="password" type="password" name="password"
                class="form-control @error('password') is-invalid @enderror" required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="remember" id="remember" class="form-check-input">
            <label class="form-check-label" for="remember">Ingat saya</label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Masuk</button>
    </form>
</x-guest-layout>