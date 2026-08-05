<?php

namespace App\Http\Controllers;

use App\Http\Requests\MutasiSiswaRequest;
use App\Models\MutasiSiswa;
use App\Models\Siswa;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class MutasiSiswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MutasiSiswa::with('siswa')->select('mutasi_siswa.*');

            return datatables()->of($data)
                ->addColumn('nama_siswa', fn($item) => $item->siswa->nama ?? '-')
                ->addColumn('nis_siswa', fn($item) => $item->siswa->nis ?? '-')
                ->addColumn('tanggal_format', fn($item) => $item->tanggal->format('d-m-Y'))
                ->addColumn('jenis_badge', function ($item) {
                    return $item->jenis_mutasi === 'Masuk'
                        ? '<span class="badge bg-success">Masuk</span>'
                        : '<span class="badge bg-danger">Keluar</span>';
                })
                ->addColumn('action', function ($item) {
                    return view('mutasi-siswa.action', compact('item'))->render();
                })
                ->rawColumns(['jenis_badge', 'action'])
                ->make(true);
        }

        return view('mutasi-siswa.index');
    }

    public function create(): View
    {
        $siswa = Siswa::orderBy('nama')->pluck('nama', 'id');
        return view('mutasi-siswa.create', compact('siswa'));
    }

    public function store(MutasiSiswaRequest $request): RedirectResponse
    {
        $mutasi = MutasiSiswa::create($request->validated());

        if ($mutasi->jenis_mutasi === 'Keluar') {
            $mutasi->siswa()->update(['status' => 'Pindah']);
        }

        ActivityLogService::catat("Menambahkan mutasi siswa: {$mutasi->siswa->nama}", 'Mutasi Siswa');

        return redirect()->route('mutasi-siswa.index')->with('success', 'Data mutasi siswa berhasil ditambahkan.');
    }

    public function edit(MutasiSiswa $mutasiSiswa): View
    {
        $siswa = Siswa::orderBy('nama')->pluck('nama', 'id');
        return view('mutasi-siswa.edit', compact('mutasiSiswa', 'siswa'));
    }

    public function update(MutasiSiswaRequest $request, MutasiSiswa $mutasiSiswa): RedirectResponse
    {
        $mutasiSiswa->update($request->validated());

        ActivityLogService::catat("Memperbarui mutasi siswa: {$mutasiSiswa->siswa->nama}", 'Mutasi Siswa');

        return redirect()->route('mutasi-siswa.index')->with('success', 'Data mutasi siswa berhasil diperbarui.');
    }

    public function destroy(MutasiSiswa $mutasiSiswa): RedirectResponse
    {
        ActivityLogService::catat("Menghapus mutasi siswa: {$mutasiSiswa->siswa->nama}", 'Mutasi Siswa');
        $mutasiSiswa->delete();

        return redirect()->route('mutasi-siswa.index')->with('success', 'Data mutasi siswa berhasil dihapus.');
    }
}
