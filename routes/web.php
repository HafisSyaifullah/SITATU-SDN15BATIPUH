<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PengaturanSekolahController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\MutasiSiswaController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    // Dashboard - semua role
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==============================
    // ADMIN ONLY
    // ==============================
    Route::middleware('role:Admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::patch('users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggle-active');

        Route::resource('roles', RoleController::class)->except(['show']);

        Route::get('pengaturan', [PengaturanSekolahController::class, 'edit'])->name('pengaturan.edit');
        Route::put('pengaturan', [PengaturanSekolahController::class, 'update'])->name('pengaturan.update');

        Route::get('backup', [BackupController::class, 'index'])->name('backup.index');
        Route::post('backup/create', [BackupController::class, 'create'])->name('backup.create');
        Route::get('backup/download/{filename}', [BackupController::class, 'download'])->name('backup.download');
        Route::delete('backup/{filename}', [BackupController::class, 'destroy'])->name('backup.destroy');
    });

    // ==============================
    // ADMIN & PETUGAS TATA USAHA
    // ==============================
    Route::middleware('role:Admin,Petugas Tata Usaha')->group(function () {
        Route::resource('guru', GuruController::class);
        Route::resource('pegawai', PegawaiController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('tahun-ajaran', TahunAjaranController::class);
        Route::resource('siswa', SiswaController::class);

        Route::resource('surat-masuk', SuratMasukController::class);
        Route::get('surat-masuk/{surat_masuk}/preview', [SuratMasukController::class, 'preview'])->name('surat-masuk.preview');

        Route::resource('surat-keluar', SuratKeluarController::class);
        Route::get('surat-keluar/{surat_keluar}/preview', [SuratKeluarController::class, 'preview'])->name('surat-keluar.preview');

        Route::get('arsip-surat', [ArsipSuratController::class, 'index'])->name('arsip-surat.index');
        Route::get('arsip-surat/{arsip_surat}/download', [ArsipSuratController::class, 'download'])->name('arsip-surat.download');

        Route::resource('mutasi-siswa', MutasiSiswaController::class);
        Route::resource('alumni', AlumniController::class);
        Route::resource('inventaris', InventarisController::class);
        Route::resource('kategori-barang', KategoriBarangController::class);
        Route::resource('agenda', AgendaController::class);
    });

    // ==============================
    // SEMUA ROLE (Laporan bersifat read/export, dibatasi tampilan di view/controller)
    // ==============================
    Route::middleware('role:Admin,Petugas Tata Usaha,Kepala Sekolah')->group(function () {
        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/guru', [LaporanController::class, 'guru'])->name('laporan.guru');
        Route::get('laporan/pegawai', [LaporanController::class, 'pegawai'])->name('laporan.pegawai');
        Route::get('laporan/siswa', [LaporanController::class, 'siswa'])->name('laporan.siswa');
        Route::get('laporan/surat-masuk', [LaporanController::class, 'suratMasuk'])->name('laporan.surat-masuk');
        Route::get('laporan/surat-keluar', [LaporanController::class, 'suratKeluar'])->name('laporan.surat-keluar');
        Route::get('laporan/inventaris', [LaporanController::class, 'inventaris'])->name('laporan.inventaris');

        Route::get('laporan/guru/pdf', [LaporanController::class, 'guruPdf'])->name('laporan.guru.pdf');
        Route::get('laporan/guru/excel', [LaporanController::class, 'guruExcel'])->name('laporan.guru.excel');
        Route::get('laporan/pegawai/pdf', [LaporanController::class, 'pegawaiPdf'])->name('laporan.pegawai.pdf');
        Route::get('laporan/pegawai/excel', [LaporanController::class, 'pegawaiExcel'])->name('laporan.pegawai.excel');
        Route::get('laporan/siswa/pdf', [LaporanController::class, 'siswaPdf'])->name('laporan.siswa.pdf');
        Route::get('laporan/siswa/excel', [LaporanController::class, 'siswaExcel'])->name('laporan.siswa.excel');
        Route::get('laporan/surat-masuk/pdf', [LaporanController::class, 'suratMasukPdf'])->name('laporan.surat-masuk.pdf');
        Route::get('laporan/surat-masuk/excel', [LaporanController::class, 'suratMasukExcel'])->name('laporan.surat-masuk.excel');
        Route::get('laporan/surat-keluar/pdf', [LaporanController::class, 'suratKeluarPdf'])->name('laporan.surat-keluar.pdf');
        Route::get('laporan/surat-keluar/excel', [LaporanController::class, 'suratKeluarExcel'])->name('laporan.surat-keluar.excel');
        Route::get('laporan/inventaris/pdf', [LaporanController::class, 'inventarisPdf'])->name('laporan.inventaris.pdf');
        Route::get('laporan/inventaris/excel', [LaporanController::class, 'inventarisExcel'])->name('laporan.inventaris.excel');
    });
});

require __DIR__ . '/auth.php';