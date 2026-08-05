<?php

namespace Database\Seeders;

use App\Models\KategoriBarang;
use Illuminate\Database\Seeder;

class KategoriBarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = ['Elektronik', 'Furnitur', 'Alat Tulis Kantor', 'Alat Peraga', 'Olahraga', 'Kebersihan'];

        foreach ($data as $nama) {
            KategoriBarang::firstOrCreate(['nama_kategori' => $nama]);
        }
    }
}
