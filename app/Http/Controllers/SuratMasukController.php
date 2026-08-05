<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuratMasukRequest;
use App\Models\ArsipSurat;
use App\Models\SuratMasuk;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $suratMasuk = SuratMasuk::with('user')->select('surat_masuk.*');

            return datatables()->of($suratMasuk)
                ->addIndexColumn()
                ->addColumn('user', fn($item) => $item->user->name ?? '-')
                ->addColumn('tanggal_format', fn($item) => $item->tanggal_surat->format('d-m-Y'))
                ->addColumn('action', function ($item) {
                    return view('surat-masuk.action', compact('item'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('surat-masuk.index');
    }

    public function create(): View
    {
        return view('surat-masuk.create');
    }

    public function store(SuratMasukRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('file_pdf')) {
            $data['file_pdf'] = $request->file('file_pdf')->store('surat-masuk', 'public');
        }

        $suratMasuk = SuratMasuk::create($data);

        ArsipSurat::create([
            'jenis_surat' => 'masuk',
            'surat_id' => $suratMasuk->id,
            'nomor_surat' => $suratMasuk->nomor_surat,
            'tanggal_surat' => $suratMasuk->tanggal_surat,
            'file_pdf' => $suratMasuk->file_pdf,
        ]);

        ActivityLogService::catat("Menambahkan surat masuk: {$suratMasuk->nomor_surat}", 'Surat Masuk');

        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil ditambahkan.');
    }

    public function edit(SuratMasuk $suratMasuk): View
    {
        return view('surat-masuk.edit', compact('suratMasuk'));
    }

    public function update(SuratMasukRequest $request, SuratMasuk $suratMasuk): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('file_pdf')) {
            if ($suratMasuk->file_pdf) {
                Storage::disk('public')->delete($suratMasuk->file_pdf);
            }
            $data['file_pdf'] = $request->file('file_pdf')->store('surat-masuk', 'public');
        }

        $suratMasuk->update($data);

        ArsipSurat::where('jenis_surat', 'masuk')
            ->where('surat_id', $suratMasuk->id)
            ->update([
                'nomor_surat' => $suratMasuk->nomor_surat,
                'tanggal_surat' => $suratMasuk->tanggal_surat,
                'file_pdf' => $suratMasuk->file_pdf,
            ]);

        ActivityLogService::catat("Memperbarui surat masuk: {$suratMasuk->nomor_surat}", 'Surat Masuk');

        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil diperbarui.');
    }

    public function destroy(SuratMasuk $suratMasuk): RedirectResponse
    {
        ArsipSurat::where('jenis_surat', 'masuk')->where('surat_id', $suratMasuk->id)->delete();

        ActivityLogService::catat("Menghapus surat masuk: {$suratMasuk->nomor_surat}", 'Surat Masuk');
        $suratMasuk->delete();

        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil dihapus.');
    }

    public function preview(SuratMasuk $suratMasuk)
    {
        if (!$suratMasuk->file_pdf || !Storage::disk('public')->exists($suratMasuk->file_pdf)) {
            abort(404, 'File tidak ditemukan.');
        }

        return response()->file(storage_path('app/public/' . $suratMasuk->file_pdf));
    }
}
