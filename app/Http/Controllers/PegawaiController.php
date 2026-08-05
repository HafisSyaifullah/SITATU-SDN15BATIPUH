<?php

namespace App\Http\Controllers;

use App\Http\Requests\PegawaiRequest;
use App\Models\Pegawai;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pegawai = Pegawai::query();

            return datatables()->of($pegawai)
                ->addIndexColumn()
                ->addColumn('status_badge', function ($item) {
                    return $item->status === 'Aktif'
                        ? '<span class="badge bg-success">Aktif</span>'
                        : '<span class="badge bg-danger">Nonaktif</span>';
                })
                ->addColumn('action', function ($item) {
                    return view('pegawai.action', compact('item'))->render();
                })
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }

        return view('pegawai.index');
    }

    public function create(): View
    {
        return view('pegawai.create');
    }

    public function store(PegawaiRequest $request): RedirectResponse
    {
        $pegawai = Pegawai::create($request->validated());

        ActivityLogService::catat("Menambahkan data pegawai: {$pegawai->nama}", 'Master Data Pegawai');

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    public function edit(Pegawai $pegawai): View
    {
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(PegawaiRequest $request, Pegawai $pegawai): RedirectResponse
    {
        $pegawai->update($request->validated());

        ActivityLogService::catat("Memperbarui data pegawai: {$pegawai->nama}", 'Master Data Pegawai');

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai): RedirectResponse
    {
        ActivityLogService::catat("Menghapus data pegawai: {$pegawai->nama}", 'Master Data Pegawai');
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
