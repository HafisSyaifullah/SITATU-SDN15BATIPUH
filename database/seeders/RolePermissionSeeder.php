<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'kelola-user',
            'kelola-hak-akses',
            'backup-database',
            'pengaturan-sekolah',
            'kelola-guru',
            'kelola-pegawai',
            'kelola-siswa',
            'kelola-kelas',
            'kelola-tahun-ajaran',
            'kelola-surat-masuk',
            'kelola-surat-keluar',
            'kelola-arsip-surat',
            'kelola-mutasi-siswa',
            'kelola-alumni',
            'kelola-inventaris',
            'kelola-kategori-barang',
            'kelola-agenda',
            'lihat-laporan',
            'export-laporan',
            'lihat-dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::all());

        $petugasTu = Role::firstOrCreate(['name' => 'Petugas Tata Usaha', 'guard_name' => 'web']);
        $petugasTu->syncPermissions([
            'kelola-guru',
            'kelola-pegawai',
            'kelola-siswa',
            'kelola-kelas',
            'kelola-tahun-ajaran',
            'kelola-surat-masuk',
            'kelola-surat-keluar',
            'kelola-arsip-surat',
            'kelola-mutasi-siswa',
            'kelola-alumni',
            'kelola-inventaris',
            'kelola-kategori-barang',
            'kelola-agenda',
            'lihat-laporan',
            'export-laporan',
            'lihat-dashboard',
        ]);

        $kepalaSekolah = Role::firstOrCreate(['name' => 'Kepala Sekolah', 'guard_name' => 'web']);
        $kepalaSekolah->syncPermissions([
            'lihat-laporan',
            'export-laporan',
            'lihat-dashboard',
        ]);
    }
}
