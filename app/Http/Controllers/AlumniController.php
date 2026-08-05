<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlumniRequest;
use App\Models\Alumni;
use App\Models\Siswa;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Alumni::query();

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return view('alumni.action', compact('item'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('alumni.index');
    }

    public function create(): View
    {
        $siswa = Siswa::where('status', 'Aktif')->orderBy('nama')->pluck('nama', 'id');
        return view('alumni.create', compact('siswa'));
    }

    public function store(AlumniRequest $request): RedirectResponse
    {
        $alumni = Alumni::create($request->validated());

        if ($alumni->siswa_id) {
            $alumni->siswa()->update(['status' => 'Lulus']);
        }

        ActivityLogService::catat("Menambahkan data alumni: {$alumni->nama}", 'Alumni');

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil ditambahkan.');
    }

    public function edit(Alumni $alumni): View
    {
        $siswa = Siswa::orderBy('nama')->pluck('nama', 'id');
        return view('alumni.edit', compact('alumni', 'siswa'));
    }

    public function update(AlumniRequest $request, Alumni $alumni): RedirectResponse
    {
        $alumni->update($request->validated());

        ActivityLogService::catat("Memperbarui data alumni: {$alumni->nama}", 'Alumni');

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil diperbarui.');
    }

    public function destroy(Alumni $alumni): RedirectResponse
    {
        ActivityLogService::catat("Menghapus data alumni: {$alumni->nama}", 'Alumni');
        $alumni->delete();

        return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil dihapus.');
    }
}
