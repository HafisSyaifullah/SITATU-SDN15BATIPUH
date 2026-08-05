<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RolePermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_has_all_permissions(): void
    {
        Permission::create(['name' => 'kelola-user', 'guard_name' => 'web']);
        $admin = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $admin->givePermissionTo('kelola-user');

        $user = User::factory()->create(['is_active' => true]);
        $user->assignRole('Admin');

        $this->assertTrue($user->hasPermissionTo('kelola-user'));
    }

    public function test_only_admin_can_access_user_management(): void
    {
        Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        Role::create(['name' => 'Petugas Tata Usaha', 'guard_name' => 'web']);

        $petugas = User::factory()->create(['is_active' => true]);
        $petugas->assignRole('Petugas Tata Usaha');

        $response = $this->actingAs($petugas)->get(route('users.index'));
        $response->assertStatus(403);
    }

    public function test_admin_can_access_user_management(): void
    {
        Role::create(['name' => 'Admin', 'guard_name' => 'web']);

        $admin = User::factory()->create(['is_active' => true]);
        $admin->assignRole('Admin');

        $response = $this->actingAs($admin)->get(route('users.index'));
        $response->assertStatus(200);
    }
}   