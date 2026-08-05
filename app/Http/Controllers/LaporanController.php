<?php

namespace App\Http\Controllers;

use App\Exports\GuruExport;
use App\Exports\InventarisExport;
use App\Exports\PegawaiExport;
use App\Exports\SiswaExport;
use App\Exports\SuratKeluarExport;
use App\Exports\SuratMasukExport;
use App\Models\Guru;
use App\Models\Inventaris;
use App\Models\Pegawai;
use App\Models\Siswa;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use App\Services\ActivityLogService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index(): View
    {
        return view('laporan.index');
    }

    public function guru(): View
    {
        $guru = Guru::orderBy('nama')->get();
        return view('laporan.guru', compact('guru'));
    }

    public function pegawai(): View
    {
        $pegawai = Pegawai::orderBy('nama')->get();
        return view('laporan.pegawai', compact('pegawai'));
    }

    public function siswa(Request $request): View
    {
        $query = Siswa::with(['kelas', 'tahunAjaran']);

        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }

        $siswa = $query->orderBy('nama')->get();
        $kelasList = \App\Models\Kelas::pluck('nama_kelas', 'id');

        return view('laporan.siswa', compact('siswa', 'kelasList'));
    }

    public function suratMasuk(Request $request): View
    {
        $query = SuratMasuk::query();

        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal_surat', [$request->dari, $request->sampai]);
        }

        $suratMasuk = $query->orderByDesc('tanggal_surat')->get();

        return view('laporan.surat-masuk', compact('suratMasuk'));
    }

    public function suratKeluar(Request $request): View
    {
        $query = SuratKeluar::query();

        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal_surat', [$request->dari, $request->sampai]);
        }

        $suratKeluar = $query->orderByDesc('tanggal_surat')->get();

        return view('laporan.surat-keluar', compact('suratKeluar'));
    }

    public function inventaris(): View
    {
        $inventaris = Inventaris::with('kategori')->orderBy('nama_barang')->get();
        return view('laporan.inventaris', compact('inventaris'));
    }

    // ===== PDF EXPORTS =====
    public function guruPdf()
    {
        $guru = Guru::orderBy('nama')->get();
        $pdf = Pdf::loadView('laporan.pdf.guru', compact('guru'))->setPaper('a4', 'landscape');
        ActivityLogService::catat('Export laporan guru ke PDF', 'Laporan');
        return $pdf->download('laporan-guru-' . now()->format('Ymd-His') . '.pdf');
    }

    public function pegawaiPdf()
    {
        $pegawai = Pegawai::orderBy('nama')->get();
        $pdf = Pdf::loadView('laporan.pdf.pegawai', compact('pegawai'))->setPaper('a4', 'landscape');
        ActivityLogService::catat('Export laporan pegawai ke PDF', 'Laporan');
        return $pdf->download('laporan-pegawai-' . now()->format('Ymd-His') . '.pdf');
    }

    public function siswaPdf(Request $request)
    {
        $query = Siswa::with(['kelas', 'tahunAjaran']);
        if ($request->filled('kelas_id')) {
            $query->where('kelas_id', $request->kelas_id);
        }
        $siswa = $query->orderBy('nama')->get();

        $pdf = Pdf::loadView('laporan.pdf.siswa', compact('siswa'))->setPaper('a4', 'landscape');
        ActivityLogService::catat('Export laporan siswa ke PDF', 'Laporan');
        return $pdf->download('laporan-siswa-' . now()->format('Ymd-His') . '.pdf');
    }

    public function suratMasukPdf(Request $request)
    {
        $query = SuratMasuk::query();
        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal_surat', [$request->dari, $request->sampai]);
        }
        $suratMasuk = $query->orderByDesc('tanggal_surat')->get();

        $pdf = Pdf::loadView('laporan.pdf.surat-masuk', compact('suratMasuk'))->setPaper('a4', 'landscape');
        ActivityLogService::catat('Export laporan surat masuk ke PDF', 'Laporan');
        return $pdf->download('laporan-surat-masuk-' . now()->format('Ymd-His') . '.pdf');
    }

    public function suratKeluarPdf(Request $request)
    {
        $query = SuratKeluar::query();
        if ($request->filled('dari') && $request->filled('sampai')) {
            $query->whereBetween('tanggal_surat', [$request->dari, $request->sampai]);
        }
        $suratKeluar = $query->orderByDesc('tanggal_surat')->get();

        $pdf = Pdf::loadView('laporan.pdf.surat-keluar', compact('suratKeluar'))->setPaper('a4', 'landscape');
        ActivityLogService::catat('Export laporan surat keluar ke PDF', 'Laporan');
        return $pdf->download('laporan-surat-keluar-' . now()->format('Ymd-His') . '.pdf');
    }

    public function inventarisPdf()
    {
        $inventaris = Inventaris::with('kategori')->orderBy('nama_barang')->get();
        $pdf = Pdf::loadView('laporan.pdf.inventaris', compact('inventaris'))->setPaper('a4', 'landscape');
        ActivityLogService::catat('Export laporan inventaris ke PDF', 'Laporan');
        return $pdf->download('laporan-inventaris-' . now()->format('Ymd-His') . '.pdf');
    }

    // ===== EXCEL EXPORTS =====
    public function guruExcel()
    {
        ActivityLogService::catat('Export laporan guru ke Excel', 'Laporan');
        return Excel::download(new GuruExport, 'laporan-guru-' . now()->format('Ymd-His') . '.xlsx');
    }

    public function pegawaiExcel()
    {
        ActivityLogService::catat('Export laporan pegawai ke Excel', 'Laporan');
        return Excel::download(new PegawaiExport, 'laporan-pegawai-' . now()->format('Ymd-His') . '.xlsx');
    }

    public function siswaExcel()
    {
        ActivityLogService::catat('Export laporan siswa ke Excel', 'Laporan');
        return Excel::download(new SiswaExport, 'laporan-siswa-' . now()->format('Ymd-His') . '.xlsx');
    }

    public function suratMasukExcel(Request $request)
    {
        ActivityLogService::catat('Export laporan surat masuk ke Excel', 'Laporan');
        return Excel::download(new SuratMasukExport($request->dari, $request->sampai), 'laporan-surat-masuk-' . now()->format('Ymd-His') . '.xlsx');
    }

    public function suratKeluarExcel(Request $request)
    {
        ActivityLogService::catat('Export laporan surat keluar ke Excel', 'Laporan');
        return Excel::download(new SuratKeluarExport($request->dari, $request->sampai), 'laporan-surat-keluar-' . now()->format('Ymd-His') . '.xlsx');
    }

    public function inventarisExcel()
    {
        ActivityLogService::catat('Export laporan inventaris ke Excel', 'Laporan');
        return Excel::download(new InventarisExport, 'laporan-inventaris-' . now()->format('Ymd-His') . '.xlsx');
    }
}