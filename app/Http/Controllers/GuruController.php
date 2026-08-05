<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuruRequest;
use App\Models\Guru;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $guru = Guru::query();

            return datatables()->of($guru)
                ->addIndexColumn()
                ->addColumn('status_badge', function ($item) {
                    return $item->status === 'Aktif'
                        ? '<span class="badge bg-success">Aktif</span>'
                        : '<span class="badge bg-danger">Nonaktif</span>';
                })
                ->addColumn('action', function ($item) {
                    return view('guru.action', compact('item'))->render();
                })
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }

        return view('guru.index');
    }

    public function create(): View
    {
        return view('guru.create');
    }

    public function store(GuruRequest $request): RedirectResponse
    {
        $guru = Guru::create($request->validated());

        ActivityLogService::catat("Menambahkan data guru: {$guru->nama}", 'Master Data Guru');

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru): View
    {
        return view('guru.edit', compact('guru'));
    }

    public function update(GuruRequest $request, Guru $guru): RedirectResponse
    {
        $guru->update($request->validated());

        ActivityLogService::catat("Memperbarui data guru: {$guru->nama}", 'Master Data Guru');

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru): RedirectResponse
    {
        ActivityLogService::catat("Menghapus data guru: {$guru->nama}", 'Master Data Guru');
        $guru->delete();

        return redirect()->route('guru.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
