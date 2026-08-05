<x-app-layout>
    <x-slot name="title">Laporan</x-slot>

    <div class="row g-3">
        @php
            $menuLaporan = [
                ['icon' => 'person-badge', 'label' => 'Laporan Guru', 'route' => 'laporan.guru', 'pdfRoute' => 'laporan.guru.pdf', 'color' => '#2563EB'],
                ['icon' => 'people', 'label' => 'Laporan Pegawai', 'route' => 'laporan.pegawai', 'pdfRoute' => 'laporan.pegawai.pdf', 'color' => '#7C3AED'],
                ['icon' => 'mortarboard', 'label' => 'Laporan Siswa', 'route' => 'laporan.siswa', 'pdfRoute' => 'laporan.siswa.pdf', 'color' => '#059669'],
                ['icon' => 'envelope-arrow-down', 'label' => 'Laporan Surat Masuk', 'route' => 'laporan.surat-masuk', 'pdfRoute' => 'laporan.surat-masuk.pdf', 'color' => '#0891B2'],
                ['icon' => 'envelope-arrow-up', 'label' => 'Laporan Surat Keluar', 'route' => 'laporan.surat-keluar', 'pdfRoute' => 'laporan.surat-keluar.pdf', 'color' => '#DC2626'],
                ['icon' => 'box-seam', 'label' => 'Laporan Inventaris', 'route' => 'laporan.inventaris', 'pdfRoute' => 'laporan.inventaris.pdf', 'color' => '#D97706'],
            ];
        @endphp

        @foreach ($menuLaporan as $menu)
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <a href="{{ route($menu['route']) }}" class="text-decoration-none text-dark">
                        <div class="p-4 text-center">
                            <div class="stat-icon mx-auto mb-2" style="background:{{ $menu['color'] }};">
                                <i class="bi bi-{{ $menu['icon'] }}"></i>
                            </div>
                            <div class="fw-semibold text-dark">{{ $menu['label'] }}</div>
                        </div>
                    </a>

                    <div class="px-4 pb-4">
                        <a href="{{ route($menu['pdfRoute']) }}" class="btn btn-sm btn-outline-danger w-100">
                            <i class="bi bi-file-earmark-pdf me-1"></i> Download PDF
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
