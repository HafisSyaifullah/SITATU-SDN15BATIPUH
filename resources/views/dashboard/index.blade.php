<x-app-layout>
    <x-slot name="title">Dashboard</x-slot>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon" style="background:#2563EB;"><i class="bi bi-person-badge"></i></div>
                <div>
                    <div class="stat-value">{{ $jumlahGuru }}</div>
                    <div class="stat-label">Guru</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon" style="background:#7C3AED;"><i class="bi bi-people"></i></div>
                <div>
                    <div class="stat-value">{{ $jumlahPegawai }}</div>
                    <div class="stat-label">Pegawai</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon" style="background:#059669;"><i class="bi bi-mortarboard"></i></div>
                <div>
                    <div class="stat-value">{{ $jumlahSiswa }}</div>
                    <div class="stat-label">Siswa</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon" style="background:#D97706;"><i class="bi bi-box-seam"></i></div>
                <div>
                    <div class="stat-value">{{ $jumlahInventaris }}</div>
                    <div class="stat-label">Inventaris</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon" style="background:#0891B2;"><i class="bi bi-envelope-arrow-down"></i></div>
                <div>
                    <div class="stat-value">{{ $jumlahSuratMasuk }}</div>
                    <div class="stat-label">Surat Masuk/Bln</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon" style="background:#DC2626;"><i class="bi bi-envelope-arrow-up"></i></div>
                <div>
                    <div class="stat-value">{{ $jumlahSuratKeluar }}</div>
                    <div class="stat-label">Surat Keluar/Bln</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-6">
            <div class="card p-3 h-100">
                <h6 class="fw-semibold mb-3">Surat Masuk & Keluar per Bulan ({{ date('Y') }})</h6>
                <canvas id="chartSurat" height="200"></canvas>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card p-3 h-100">
                <h6 class="fw-semibold mb-3">Inventaris per Kategori</h6>
                <canvas id="chartInventaris" height="220"></canvas>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card p-3 h-100">
                <h6 class="fw-semibold mb-3">Siswa per Kelas</h6>
                <canvas id="chartSiswa" height="220"></canvas>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-5">
            <div class="card p-3 h-100">
                <h6 class="fw-semibold mb-3"><i class="bi bi-calendar-event me-1"></i> Agenda Hari Ini</h6>
                @forelse ($agendaHariIni as $agenda)
                    <div class="d-flex align-items-start gap-2 mb-3 pb-3 border-bottom">
                        <div class="text-primary fw-semibold" style="min-width:55px">{{ substr($agenda->jam, 0, 5) }}</div>
                        <div>
                            <div class="fw-semibold" style="font-size:.9rem">{{ $agenda->judul }}</div>
                            <div class="text-muted" style="font-size:.8rem">{{ $agenda->tempat }}</div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center py-3 mb-0">Tidak ada agenda hari ini.</p>
                @endforelse
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card p-3 h-100">
                <h6 class="fw-semibold mb-3"><i class="bi bi-clock-history me-1"></i> Aktivitas Terbaru</h6>
                @forelse ($aktivitasTerbaru as $log)
                    <div class="d-flex align-items-start gap-2 mb-3 pb-3 border-bottom">
                        <div class="stat-icon" style="width:36px;height:36px;font-size:.9rem;background:#EFF6FF;color:#2563EB;">
                            <i class="bi bi-activity"></i>
                        </div>
                        <div>
                            <div style="font-size:.87rem">
                                <strong>{{ $log->user->name ?? 'Sistem' }}</strong> - {{ $log->activity }}
                            </div>
                            <div class="text-muted" style="font-size:.75rem">
                                {{ $log->module }} &middot; {{ $log->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center py-3 mb-0">Belum ada aktivitas.</p>
                @endforelse
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const labelBulan = @json($labelBulan);
            const dataSuratMasuk = @json($dataSuratMasuk);
            const dataSuratKeluar = @json($dataSuratKeluar);

            new Chart(document.getElementById('chartSurat'), {
                type: 'line',
                data: {
                    labels: labelBulan,
                    datasets: [
                        {
                            label: 'Surat Masuk',
                            data: dataSuratMasuk,
                            borderColor: '#2563EB',
                            backgroundColor: 'rgba(37,99,235,0.1)',
                            tension: 0.3,
                            fill: true,
                        },
                        {
                            label: 'Surat Keluar',
                            data: dataSuratKeluar,
                            borderColor: '#059669',
                            backgroundColor: 'rgba(5,150,105,0.1)',
                            tension: 0.3,
                            fill: true,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom' } },
                    scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
                },
            });

            const labelKategori = @json($labelKategori);
            const dataKategori = @json($dataKategori);

            new Chart(document.getElementById('chartInventaris'), {
                type: 'doughnut',
                data: {
                    labels: labelKategori,
                    datasets: [{
                        data: dataKategori,
                        backgroundColor: ['#2563EB', '#7C3AED', '#059669', '#D97706', '#0891B2', '#DC2626'],
                    }],
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 10 } } } },
                },
            });

            const labelKelas = @json($labelKelas);
            const dataKelas = @json($dataKelas);

            new Chart(document.getElementById('chartSiswa'), {
                type: 'bar',
                data: {
                    labels: labelKelas,
                    datasets: [{
                        label: 'Jumlah Siswa',
                        data: dataKelas,
                        backgroundColor: '#2563EB',
                        borderRadius: 6,
                    }],
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, ticks: { precision: 0 } } },
                },
            });
        </script>
    @endpush
</x-app-layout>