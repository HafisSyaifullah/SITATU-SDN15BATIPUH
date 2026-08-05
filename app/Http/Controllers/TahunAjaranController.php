<?php

namespace App\Http\Controllers;

use App\Http\Requests\TahunAjaranRequest;
use App\Models\TahunAjaran;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class TahunAjaranController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TahunAjaran::query();

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('status_badge', function ($item) {
                    return $item->status_aktif
                        ? '<span class="badge bg-success">Aktif</span>'
                        : '<span class="badge bg-secondary">Nonaktif</span>';
                })
                ->addColumn('action', function ($item) {
                    return view('tahun-ajaran.action', compact('item'))->render();
                })
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }

        return view('tahun-ajaran.index');
    }

    public function create(): View
    {
        return view('tahun-ajaran.create');
    }

    public function store(TahunAjaranRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['status_aktif'] = $request->boolean('status_aktif');

        if ($data['status_aktif']) {
            TahunAjaran::query()->update(['status_aktif' => false]);
        }

        $tahunAjaran = TahunAjaran::create($data);

        ActivityLogService::catat("Menambahkan tahun ajaran: {$tahunAjaran->tahun} {$tahunAjaran->semester}", 'Master Data Tahun Ajaran');

        return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun ajaran berhasil ditambahkan.');
    }

    public function edit(TahunAjaran $tahunAjaran): View
    {
        return view('tahun-ajaran.edit', compact('tahunAjaran'));
    }

    public function update(TahunAjaranRequest $request, TahunAjaran $tahunAjaran): RedirectResponse
    {
        $data = $request->validated();
        $data['status_aktif'] = $request->boolean('status_aktif');

        if ($data['status_aktif']) {
            TahunAjaran::where('id', '!=', $tahunAjaran->id)->update(['status_aktif' => false]);
        }

        $tahunAjaran->update($data);

        ActivityLogService::catat("Memperbarui tahun ajaran: {$tahunAjaran->tahun} {$tahunAjaran->semester}", 'Master Data Tahun Ajaran');

        return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun ajaran berhasil diperbarui.');
    }

    public function destroy(TahunAjaran $tahunAjaran): RedirectResponse
    {
        if ($tahunAjaran->siswa()->exists()) {
            return back()->with('error', 'Tahun ajaran tidak dapat dihapus karena masih memiliki data siswa.');
        }

        ActivityLogService::catat("Menghapus tahun ajaran: {$tahunAjaran->tahun} {$tahunAjaran->semester}", 'Master Data Tahun Ajaran');
        $tahunAjaran->delete();

        return redirect()->route('tahun-ajaran.index')->with('success', 'Tahun ajaran berhasil dihapus.');
    }
}
