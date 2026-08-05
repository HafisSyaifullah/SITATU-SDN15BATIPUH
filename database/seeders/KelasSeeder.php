<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_kelas' => 'I A', 'tingkat' => '1', 'wali_kelas' => 'Siti Aminah, S.Pd'],
            ['nama_kelas' => 'II A', 'tingkat' => '2', 'wali_kelas' => 'Budi Santoso, S.Pd'],
            ['nama_kelas' => 'III A', 'tingkat' => '3', 'wali_kelas' => 'Rina Wijaya, S.Pd'],
            ['nama_kelas' => 'IV A', 'tingkat' => '4', 'wali_kelas' => 'Ahmad Fauzi, S.Pd'],
            ['nama_kelas' => 'V A', 'tingkat' => '5', 'wali_kelas' => 'Dewi Lestari, S.Pd'],
            ['nama_kelas' => 'VI A', 'tingkat' => '6', 'wali_kelas' => 'Hendra Gunawan, S.Pd'],
        ];

        foreach ($data as $item) {
            Kelas::firstOrCreate(['nama_kelas' => $item['nama_kelas']], $item);
        }
    }
}
