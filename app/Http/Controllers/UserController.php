<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        if ($request->ajax()) {
            $users = User::with('roles')->select('users.*');

            return datatables()->of($users)
                ->addIndexColumn()
                ->addColumn('role', fn($user) => $user->roles->pluck('name')->implode(', '))
                ->addColumn('status', function ($user) {
                    return $user->is_active
                        ? '<span class="badge bg-success">Aktif</span>'
                        : '<span class="badge bg-danger">Nonaktif</span>';
                })
                ->addColumn('action', function ($user) {
                    return view('users.action', compact('user'))->render();
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }

        return view('users.index');
    }

    public function create(): View
    {
        $roles = Role::pluck('name', 'name');
        return view('users.create', compact('roles'));
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-user', 'public');
        }

        $user = User::create($data);
        $user->assignRole($request->role);

        ActivityLogService::catat("Menambahkan user: {$user->name}", 'Manajemen User');

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user): View
    {
        $roles = Role::pluck('name', 'name');
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-user', 'public');
        }

        $user->update($data);
        $user->syncRoles([$request->role]);

        ActivityLogService::catat("Memperbarui user: {$user->name}", 'Manajemen User');

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }

        ActivityLogService::catat("Menghapus user: {$user->name}", 'Manajemen User');

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

    public function toggleActive(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menonaktifkan akun sendiri.');
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'mengaktifkan' : 'menonaktifkan';
        ActivityLogService::catat("Berhasil {$status} user: {$user->name}", 'Manajemen User');

        return back()->with('success', 'Status user berhasil diperbarui.');
    }
}