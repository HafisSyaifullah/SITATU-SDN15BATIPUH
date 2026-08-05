<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\ActivityLog;
use App\Models\Guru;
use App\Models\Inventaris;
use App\Models\KategoriBarang;
use App\Models\Kelas;
use App\Models\Pegawai;
use App\Models\Siswa;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $jumlahGuru = Guru::where('status', 'Aktif')->count();
        $jumlahPegawai = Pegawai::where('status', 'Aktif')->count();
        $jumlahSiswa = Siswa::where('status', 'Aktif')->count();
        $jumlahInventaris = Inventaris::sum('jumlah');
        $jumlahSuratMasuk = SuratMasuk::whereMonth('tanggal_surat', now()->month)
            ->whereYear('tanggal_surat', now()->year)->count();
        $jumlahSuratKeluar = SuratKeluar::whereMonth('tanggal_surat', now()->month)
            ->whereYear('tanggal_surat', now()->year)->count();

        $agendaHariIni = Agenda::whereDate('tanggal', Carbon::today())
            ->orderBy('jam')
            ->get();

        // Grafik surat masuk per bulan (tahun berjalan)
        $suratMasukPerBulan = SuratMasuk::select(
            DB::raw('MONTH(tanggal_surat) as bulan'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('tanggal_surat', now()->year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $suratKeluarPerBulan = SuratKeluar::select(
            DB::raw('MONTH(tanggal_surat) as bulan'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('tanggal_surat', now()->year)
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $labelBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $dataSuratMasuk = [];
        $dataSuratKeluar = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataSuratMasuk[] = $suratMasukPerBulan[$i] ?? 0;
            $dataSuratKeluar[] = $suratKeluarPerBulan[$i] ?? 0;
        }

        // Inventaris per kategori
        $inventarisPerKategori = KategoriBarang::withSum('inventaris', 'jumlah')->get();
        $labelKategori = $inventarisPerKategori->pluck('nama_kategori');
        $dataKategori = $inventarisPerKategori->pluck('inventaris_sum_jumlah')->map(fn($v) => $v ?? 0);

        // Siswa per kelas
        $siswaPerKelas = Kelas::withCount(['siswa' => function ($q) {
            $q->where('status', 'Aktif');
        }])->get();
        $labelKelas = $siswaPerKelas->pluck('nama_kelas');
        $dataKelas = $siswaPerKelas->pluck('siswa_count');

        $aktivitasTerbaru = ActivityLog::with('user')
            ->latest()
            ->limit(10)
            ->get();

        return view('dashboard.index', compact(
            'jumlahGuru',
            'jumlahPegawai',
            'jumlahSiswa',
            'jumlahInventaris',
            'jumlahSuratMasuk',
            'jumlahSuratKeluar',
            'agendaHariIni',
            'labelBulan',
            'dataSuratMasuk',
            'dataSuratKeluar',
            'labelKategori',
            'dataKategori',
            'labelKelas',
            'dataKelas',
            'aktivitasTerbaru'
        ));
    }
}