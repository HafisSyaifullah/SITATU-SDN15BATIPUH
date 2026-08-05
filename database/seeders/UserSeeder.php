<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@sdn15batipuh.sch.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('Admin');

        $petugas = User::firstOrCreate(
            ['email' => 'tu@sdn15batipuh.sch.id'],
            [
                'name' => 'Petugas Tata Usaha',
                'password' => Hash::make('password123'),
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $petugas->assignRole('Petugas Tata Usaha');

        $kepsek = User::firstOrCreate(
            ['email' => 'kepsek@sdn15batipuh.sch.id'],
            [
                'name' => 'Kepala Sekolah',
                'password' => Hash::make('password123'),
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );
        $kepsek->assignRole('Kepala Sekolah');
    }
}
