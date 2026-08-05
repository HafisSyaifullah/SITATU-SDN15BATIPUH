<header class="topbar">
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-sm btn-toggle-sidebar" id="sidebarToggle" type="button">
            <i class="bi bi-list fs-4"></i>
        </button>
        <h5 class="mb-0 page-title">{{ $title ?? 'Dashboard' }}</h5>
    </div>

    <div class="dropdown">
        <button class="btn d-flex align-items-center gap-2 user-dropdown-btn" type="button" data-bs-toggle="dropdown">
            <img src="{{ auth()->user()->foto_url }}" class="rounded-circle" width="36" height="36" alt="Foto">
            <div class="text-start d-none d-md-block">
                <div class="fw-semibold" style="font-size:.85rem">{{ auth()->user()->name }}</div>
                <div class="text-muted" style="font-size:.75rem">{{ auth()->user()->roles->pluck('name')->first() }}</div>
            </div>
            <i class="bi bi-chevron-down"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                </form>
            </li>
        </ul>
    </div>
</header>