<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiswaRequest;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $siswa = Siswa::with(['kelas', 'tahunAjaran'])->select('siswa.*');

            return datatables()->of($siswa)
                ->addIndexColumn()
                ->addColumn('kelas', fn($item) => $item->kelas->nama_kelas ?? '-')
                ->addColumn('tahun_ajaran', fn($item) => $item->tahunAjaran ? "{$item->tahunAjaran->tahun} ({$item->tahunAjaran->semester})" : '-')
                ->addColumn('status_badge', function ($item) {
                    $color = match ($item->status) {
                        'Aktif' => 'success',
                        'Pindah' => 'warning',
                        'Lulus' => 'info',
                        'Keluar' => 'danger',
                        default => 'secondary',
                    };
                    return "<span class='badge bg-{$color}'>{$item->status}</span>";
                })
                ->addColumn('action', function ($item) {
                    return view('siswa.action', compact('item'))->render();
                })
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }

        return view('siswa.index');
    }

    public function create(): View
    {
        $kelas = Kelas::pluck('nama_kelas', 'id');
        $tahunAjaran = TahunAjaran::orderByDesc('id')->get();

        return view('siswa.create', compact('kelas', 'tahunAjaran'));
    }

    public function store(SiswaRequest $request): RedirectResponse
    {
        $siswa = Siswa::create($request->validated());

        ActivityLogService::catat("Menambahkan data siswa: {$siswa->nama}", 'Master Data Siswa');

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa): View
    {
        $kelas = Kelas::pluck('nama_kelas', 'id');
        $tahunAjaran = TahunAjaran::orderByDesc('id')->get();

        return view('siswa.edit', compact('siswa', 'kelas', 'tahunAjaran'));
    }

    public function update(SiswaRequest $request, Siswa $siswa): RedirectResponse
    {
        $siswa->update($request->validated());

        ActivityLogService::catat("Memperbarui data siswa: {$siswa->nama}", 'Master Data Siswa');

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa): RedirectResponse
    {
        ActivityLogService::catat("Menghapus data siswa: {$siswa->nama}", 'Master Data Siswa');
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
