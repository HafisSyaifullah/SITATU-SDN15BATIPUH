<x-app-layout>
    <x-slot name="title">Laporan</x-slot>

    <div class="row g-3">
        @php
            $menuLaporan = [
                ['icon' => 'person-badge', 'label' => 'Laporan Guru', 'route' => 'laporan.guru', 'color' => '#2563EB'],
                ['icon' => 'people', 'label' => 'Laporan Pegawai', 'route' => 'laporan.pegawai', 'color' => '#7C3AED'],
                ['icon' => 'mortarboard', 'label' => 'Laporan Siswa', 'route' => 'laporan.siswa', 'color' => '#059669'],
                ['icon' => 'envelope-arrow-down', 'label' => 'Laporan Surat Masuk', 'route' => 'laporan.surat-masuk', 'color' => '#0891B2'],
                ['icon' => 'envelope-arrow-up', 'label' => 'Laporan Surat Keluar', 'route' => 'laporan.surat-keluar', 'color' => '#DC2626'],
                ['icon' => 'box-seam', 'label' => 'Laporan Inventaris', 'route' => 'laporan.inventaris', 'color' => '#D97706'],
            ];
        @endphp

        @foreach ($menuLaporan as $menu)
            <div class="col-md-4">
                <a href="{{ route($menu['route']) }}" class="text-decoration-none">
                    <div class="card p-4 h-100 text-center">
                        <div class="stat-icon mx-auto mb-2" style="background:{{ $menu['color'] }};">
                            <i class="bi bi-{{ $menu['icon'] }}"></i>
                        </div>
                        <div class="fw-semibold text-dark">{{ $menu['label'] }}</div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</x-app-layout>