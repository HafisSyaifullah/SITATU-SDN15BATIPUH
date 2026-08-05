<?php

namespace App\Http\Controllers;

use App\Services\ActivityLogService;
use App\Services\BackupService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BackupController extends Controller
{
    public function __construct(protected BackupService $backupService)
    {
    }

    public function index(): View
    {
        $backups = $this->backupService->list();

        return view('backup.index', compact('backups'));
    }

    public function create(): RedirectResponse
    {
        try {
            $filename = $this->backupService->create();
            ActivityLogService::catat("Membuat backup database: {$filename}", 'Backup Database');

            return back()->with('success', 'Backup database berhasil dibuat.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal membuat backup: ' . $e->getMessage());
        }
    }

    public function download(string $filename): StreamedResponse
    {
        $path = 'backup/' . $filename;

        if (! Storage::disk('public')->exists($path)) {
            abort(404, 'File backup tidak ditemukan.');
        }

        ActivityLogService::catat("Mengunduh backup database: {$filename}", 'Backup Database');

        return Storage::disk('public')->download($path);
    }

    public function destroy(string $filename): RedirectResponse
    {
        $this->backupService->delete($filename);
        ActivityLogService::catat("Menghapus backup database: {$filename}", 'Backup Database');

        return back()->with('success', 'File backup berhasil dihapus.');
    }
}
