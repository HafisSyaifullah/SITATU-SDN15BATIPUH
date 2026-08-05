<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class BackupService
{
    public function create(): string
    {
        $filename = 'backup-' . now()->format('Y-m-d_His') . '.sql';
        $path = storage_path('app/public/backup');

        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }

        $fullPath = $path . '/' . $filename;

        $dbHost = config('database.connections.mysql.host');
        $dbPort = config('database.connections.mysql.port');
        $dbName = config('database.connections.mysql.database');
        $dbUser = config('database.connections.mysql.username');
        $dbPass = config('database.connections.mysql.password');

        $command = [
            'mysqldump',
            '-h', $dbHost,
            '-P', $dbPort,
            '-u', $dbUser,
        ];

        if (! empty($dbPass)) {
            $command[] = '-p' . $dbPass;
        }

        $command[] = $dbName;

        $process = new Process($command);
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) use ($fullPath) {
            file_put_contents($fullPath, $buffer, FILE_APPEND);
        });

        if (! $process->isSuccessful() || ! file_exists($fullPath) || filesize($fullPath) === 0) {
            throw new \RuntimeException('Gagal membuat backup database. Pastikan mysqldump tersedia di server.');
        }

        return $filename;
    }

    public function list(): array
    {
        $path = 'backup';
        if (! Storage::disk('public')->exists($path)) {
            return [];
        }

        $files = Storage::disk('public')->files($path);

        return collect($files)->map(function ($file) {
            return [
                'name' => basename($file),
                'size' => Storage::disk('public')->size($file),
                'date' => Storage::disk('public')->lastModified($file),
            ];
        })->sortByDesc('date')->values()->toArray();
    }

    public function delete(string $filename): bool
    {
        return Storage::disk('public')->delete('backup/' . $filename);
    }
}
