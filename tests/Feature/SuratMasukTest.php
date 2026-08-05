<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class SuratMasukTest extends TestCase
{
    use RefreshDatabase;

    protected User $petugas;

    protected function setUp(): void
    {
        parent::setUp();

        Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        Role::create(['name' => 'Petugas Tata Usaha', 'guard_name' => 'web']);
        Role::create(['name' => 'Kepala Sekolah', 'guard_name' => 'web']);

        $this->petugas = User::factory()->create(['is_active' => true]);
        $this->petugas->assignRole('Petugas Tata Usaha');

        Storage::fake('public');
    }

    public function test_petugas_tu_can_create_surat_masuk_with_pdf_attachment(): void
    {
        $file = UploadedFile::fake()->create('surat.pdf', 500, 'application/pdf');

        $data = [
            'nomor_surat' => '001/SM/2026',
            'tanggal_surat' => '2026-08-01',
            'pengirim' => 'Dinas Pendidikan Kab. Tanah Datar',
            'perihal' => 'Undangan Rapat Koordinasi',
            'file_pdf' => $file,
        ];

        $response = $this->actingAs($this->petugas)->post(route('surat-masuk.store'), $data);

        $response->assertRedirect(route('surat-masuk.index'));
        $this->assertDatabaseHas('surat_masuk', ['nomor_surat' => '001/SM/2026']);
        $this->assertDatabaseHas('arsip_surat', ['nomor_surat' => '001/SM/2026', 'jenis_surat' => 'masuk']);
    }

    public function test_surat_masuk_requires_pdf_file(): void
    {
        $response = $this->actingAs($this->petugas)->post(route('surat-masuk.store'), [
            'nomor_surat' => '002/SM/2026',
            'tanggal_surat' => '2026-08-01',
            'pengirim' => 'Test Pengirim',
            'perihal' => 'Test Perihal',
        ]);

        $response->assertSessionHasErrors('file_pdf');
    }
}