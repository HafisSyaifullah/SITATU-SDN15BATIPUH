<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['tahun' => '2024/2025', 'semester' => 'Ganjil', 'status_aktif' => false],
            ['tahun' => '2024/2025', 'semester' => 'Genap', 'status_aktif' => false],
            ['tahun' => '2025/2026', 'semester' => 'Ganjil', 'status_aktif' => true],
        ];

        foreach ($data as $item) {
            TahunAjaran::firstOrCreate(
                ['tahun' => $item['tahun'], 'semester' => $item['semester']],
                $item
            );
        }
    }
}
