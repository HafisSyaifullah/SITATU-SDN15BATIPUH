<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::withCount('permissions')->get();

        return view('roles.index', compact('roles'));
    }

    public function create(): View
    {
        $permissions = Permission::all()->groupBy(function ($item) {
            return explode('-', $item->name)[0];
        });

        return view('roles.create', compact('permissions'));
    }

    public function store(RoleRequest $request): RedirectResponse
    {
        $role = Role::create(['name' => $request->name, 'guard_name' => 'web']);
        $role->syncPermissions($request->permissions ?? []);

        ActivityLogService::catat("Menambahkan role: {$role->name}", 'Hak Akses');

        return redirect()->route('roles.index')->with('success', 'Role berhasil ditambahkan.');
    }

    public function edit(Role $role): View
    {
        $permissions = Permission::all()->groupBy(function ($item) {
            return explode('-', $item->name)[0];
        });
        $rolePermissions = $role->permissions->pluck('name')->toArray();

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        if (in_array($role->name, ['Admin', 'Petugas Tata Usaha', 'Kepala Sekolah']) && $request->name !== $role->name) {
            return back()->with('error', 'Nama role default tidak dapat diubah.');
        }

        $role->update(['name' => $request->name]);
        $role->syncPermissions($request->permissions ?? []);

        ActivityLogService::catat("Memperbarui role: {$role->name}", 'Hak Akses');

        return redirect()->route('roles.index')->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if (in_array($role->name, ['Admin', 'Petugas Tata Usaha', 'Kepala Sekolah'])) {
            return back()->with('error', 'Role default tidak dapat dihapus.');
        }

        ActivityLogService::catat("Menghapus role: {$role->name}", 'Hak Akses');
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus.');
    }
}
