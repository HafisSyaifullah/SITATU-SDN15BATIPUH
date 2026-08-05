<?php

namespace Database\Seeders;

use App\Models\PengaturanSekolah;
use Illuminate\Database\Seeder;

class PengaturanSekolahSeeder extends Seeder
{
    public function run(): void
    {
        PengaturanSekolah::firstOrCreate(
            ['nama_sekolah' => 'SD Negeri 15 Batipuh'],
            [
                'npsn' => '10305xxx',
                'alamat' => 'Kec. Batipuh, Kabupaten Tanah Datar, Sumatera Barat',
                'kepala_sekolah' => 'Kepala Sekolah SDN 15 Batipuh',
                'email' => 'sdn15batipuh@gmail.com',
                'telepon' => '0752-xxxxxx',
            ]
        );
    }
}
