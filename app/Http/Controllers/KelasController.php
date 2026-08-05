<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasRequest;
use App\Models\Kelas;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $kelas = Kelas::withCount('siswa')->select('kelas.*');

            return datatables()->of($kelas)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return view('kelas.action', compact('item'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('kelas.index');
    }

    public function create(): View
    {
        return view('kelas.create');
    }

    public function store(KelasRequest $request): RedirectResponse
    {
        $kelas = Kelas::create($request->validated());

        ActivityLogService::catat("Menambahkan data kelas: {$kelas->nama_kelas}", 'Master Data Kelas');

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    public function edit(Kelas $kelas): View
    {
        return view('kelas.edit', compact('kelas'));
    }

    public function update(KelasRequest $request, Kelas $kelas): RedirectResponse
    {
        $kelas->update($request->validated());

        ActivityLogService::catat("Memperbarui data kelas: {$kelas->nama_kelas}", 'Master Data Kelas');

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Kelas $kelas): RedirectResponse
    {
        if ($kelas->siswa()->exists()) {
            return back()->with('error', 'Kelas tidak dapat dihapus karena masih memiliki data siswa.');
        }

        ActivityLogService::catat("Menghapus data kelas: {$kelas->nama_kelas}", 'Master Data Kelas');
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
