<?php

namespace Tests\Feature;

use App\Models\Guru;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class GuruManagementTest extends TestCase
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
    }

    public function test_petugas_tu_can_view_guru_index(): void
    {
        $response = $this->actingAs($this->petugas)->get(route('guru.index'));
        $response->assertStatus(200);
    }

    public function test_petugas_tu_can_create_guru(): void
    {
        $data = [
            'nip' => '198001012005011001',
            'nama' => 'Ahmad Fauzi, S.Pd',
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'Batipuh',
            'tanggal_lahir' => '1980-01-01',
            'alamat' => 'Jl. Pendidikan No. 1',
            'no_hp' => '081234567890',
            'jabatan' => 'Guru Kelas',
            'status' => 'Aktif',
        ];

        $response = $this->actingAs($this->petugas)->post(route('guru.store'), $data);

        $response->assertRedirect(route('guru.index'));
        $this->assertDatabaseHas('guru', ['nip' => '198001012005011001', 'nama' => 'Ahmad Fauzi, S.Pd']);
    }

    public function test_guru_creation_requires_valid_data(): void
    {
        $response = $this->actingAs($this->petugas)->post(route('guru.store'), []);
        $response->assertSessionHasErrors(['nip', 'nama', 'jenis_kelamin', 'status']);
    }

    public function test_petugas_tu_can_update_guru(): void
    {
        $guru = Guru::factory()->create();

        $response = $this->actingAs($this->petugas)->put(route('guru.update', $guru->id), [
            'nip' => $guru->nip,
            'nama' => 'Nama Diperbarui',
            'jenis_kelamin' => $guru->jenis_kelamin,
            'status' => 'Aktif',
        ]);

        $response->assertRedirect(route('guru.index'));
        $this->assertDatabaseHas('guru', ['id' => $guru->id, 'nama' => 'Nama Diperbarui']);
    }

    public function test_petugas_tu_can_delete_guru(): void
    {
        $guru = Guru::factory()->create();

        $response = $this->actingAs($this->petugas)->delete(route('guru.destroy', $guru->id));

        $response->assertRedirect(route('guru.index'));
        $this->assertSoftDeleted('guru', ['id' => $guru->id]);
    }

    public function test_guest_cannot_access_guru_module(): void
    {
        $response = $this->get(route('guru.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_kepala_sekolah_cannot_access_guru_module(): void
    {
        $kepsek = User::factory()->create(['is_active' => true]);
        $kepsek->assignRole('Kepala Sekolah');

        $response = $this->actingAs($kepsek)->get(route('guru.index'));
        $response->assertStatus(403);
    }
}