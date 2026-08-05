<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratKeluarRequest;
use App\Models\ArsipSurat;
use App\Models\SuratKeluar;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class SuratKeluarController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $suratKeluar = SuratKeluar::with('user')->select('surat_keluar.*');

            return datatables()->of($suratKeluar)
                ->addIndexColumn()
                ->addColumn('user', fn($item) => $item->user->name ?? '-')
                ->addColumn('tanggal_format', fn($item) => $item->tanggal_surat->format('d-m-Y'))
                ->addColumn('action', function ($item) {
                    return view('surat-keluar.action', compact('item'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('surat-keluar.index');
    }

    public function create(): View
    {
        return view('surat-keluar.create');
    }

    public function store(SuratKeluarRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('file_pdf')) {
            $data['file_pdf'] = $request->file('file_pdf')->store('surat-keluar', 'public');
        }

        $suratKeluar = SuratKeluar::create($data);

        ArsipSurat::create([
            'jenis_surat' => 'keluar',
            'surat_id' => $suratKeluar->id,
            'nomor_surat' => $suratKeluar->nomor_surat,
            'tanggal_surat' => $suratKeluar->tanggal_surat,
            'file_pdf' => $suratKeluar->file_pdf,
        ]);

        ActivityLogService::catat("Menambahkan surat keluar: {$suratKeluar->nomor_surat}", 'Surat Keluar');

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil ditambahkan.');
    }

    public function edit(SuratKeluar $suratKeluar): View
    {
        return view('surat-keluar.edit', compact('suratKeluar'));
    }

    public function update(SuratKeluarRequest $request, SuratKeluar $suratKeluar): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('file_pdf')) {
            if ($suratKeluar->file_pdf) {
                Storage::disk('public')->delete($suratKeluar->file_pdf);
            }
            $data['file_pdf'] = $request->file('file_pdf')->store('surat-keluar', 'public');
        }

        $suratKeluar->update($data);

        ArsipSurat::where('jenis_surat', 'keluar')
            ->where('surat_id', $suratKeluar->id)
            ->update([
                'nomor_surat' => $suratKeluar->nomor_surat,
                'tanggal_surat' => $suratKeluar->tanggal_surat,
                'file_pdf' => $suratKeluar->file_pdf,
            ]);

        ActivityLogService::catat("Memperbarui surat keluar: {$suratKeluar->nomor_surat}", 'Surat Keluar');

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil diperbarui.');
    }

    public function destroy(SuratKeluar $suratKeluar): RedirectResponse
    {
        ArsipSurat::where('jenis_surat', 'keluar')->where('surat_id', $suratKeluar->id)->delete();

        ActivityLogService::catat("Menghapus surat keluar: {$suratKeluar->nomor_surat}", 'Surat Keluar');
        $suratKeluar->delete();

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil dihapus.');
    }

    public function preview(SuratKeluar $suratKeluar)
    {
        if (!$suratKeluar->file_pdf || !Storage::disk('public')->exists($suratKeluar->file_pdf)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->file(storage_path('app/public/' . $suratKeluar->file_pdf));
    }
}
