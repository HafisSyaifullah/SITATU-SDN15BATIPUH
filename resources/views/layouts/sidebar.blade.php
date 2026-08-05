<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <i class="bi bi-mortarboard-fill"></i>
        <span class="brand-text">SITU SDN 15<br><small>Batipuh</small></span>
    </div>

    <nav class="sidebar-nav">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> <span>Dashboard</span>
        </a>

        @if (auth()->user()->hasAnyRole(['Admin', 'Petugas Tata Usaha']))
            <div class="nav-section-title">Master Data</div>

            <a href="{{ route('guru.index') }}" class="nav-link {{ request()->routeIs('guru.*') ? 'active' : '' }}">
                <i class="bi bi-person-badge"></i> <span>Data Guru</span>
            </a>
            <a href="{{ route('pegawai.index') }}" class="nav-link {{ request()->routeIs('pegawai.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> <span>Data Pegawai</span>
            </a>
            <a href="{{ route('siswa.index') }}" class="nav-link {{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                <i class="bi bi-mortarboard"></i> <span>Data Siswa</span>
            </a>
            <a href="{{ route('kelas.index') }}" class="nav-link {{ request()->routeIs('kelas.*') ? 'active' : '' }}">
                <i class="bi bi-door-open"></i> <span>Data Kelas</span>
            </a>
            <a href="{{ route('tahun-ajaran.index') }}" class="nav-link {{ request()->routeIs('tahun-ajaran.*') ? 'active' : '' }}">
                <i class="bi bi-calendar3"></i> <span>Tahun Ajaran</span>
            </a>

            <div class="nav-section-title">Administrasi</div>

            <a href="{{ route('surat-masuk.index') }}" class="nav-link {{ request()->routeIs('surat-masuk.*') ? 'active' : '' }}">
                <i class="bi bi-envelope-arrow-down"></i> <span>Surat Masuk</span>
            </a>
            <a href="{{ route('surat-keluar.index') }}" class="nav-link {{ request()->routeIs('surat-keluar.*') ? 'active' : '' }}">
                <i class="bi bi-envelope-arrow-up"></i> <span>Surat Keluar</span>
            </a>
            <a href="{{ route('arsip-surat.index') }}" class="nav-link {{ request()->routeIs('arsip-surat.*') ? 'active' : '' }}">
                <i class="bi bi-archive"></i> <span>Arsip Surat</span>
            </a>
            <a href="{{ route('mutasi-siswa.index') }}" class="nav-link {{ request()->routeIs('mutasi-siswa.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right"></i> <span>Mutasi Siswa</span>
            </a>
            <a href="{{ route('alumni.index') }}" class="nav-link {{ request()->routeIs('alumni.*') ? 'active' : '' }}">
                <i class="bi bi-award"></i> <span>Alumni</span>
            </a>
            <a href="{{ route('inventaris.index') }}" class="nav-link {{ request()->routeIs('inventaris.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> <span>Inventaris</span>
            </a>
            <a href="{{ route('kategori-barang.index') }}" class="nav-link {{ request()->routeIs('kategori-barang.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> <span>Kategori Barang</span>
            </a>
            <a href="{{ route('agenda.index') }}" class="nav-link {{ request()->routeIs('agenda.*') ? 'active' : '' }}">
                <i class="bi bi-calendar-event"></i> <span>Agenda Sekolah</span>
            </a>
        @endif

        <div class="nav-section-title">Laporan</div>
        <a href="{{ route('laporan.index') }}" class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-bar-graph"></i> <span>Laporan</span>
        </a>

        @if (auth()->user()->hasRole('Admin'))
            <div class="nav-section-title">Pengaturan</div>

            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="bi bi-person-gear"></i> <span>Kelola User</span>
            </a>
            <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                <i class="bi bi-shield-lock"></i> <span>Hak Akses</span>
            </a>
            <a href="{{ route('pengaturan.edit') }}" class="nav-link {{ request()->routeIs('pengaturan.*') ? 'active' : '' }}">
                <i class="bi bi-gear"></i> <span>Pengaturan Sekolah</span>
            </a>
            <a href="{{ route('backup.index') }}" class="nav-link {{ request()->routeIs('backup.*') ? 'active' : '' }}">
                <i class="bi bi-database-down"></i> <span>Backup Database</span>
            </a>
        @endif
    </nav>
</aside>