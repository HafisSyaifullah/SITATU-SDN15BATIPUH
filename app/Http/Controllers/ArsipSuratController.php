<?php

namespace App\Http\Controllers;

use App\Models\ArsipSurat;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\JsonResponse;

class ArsipSuratController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = ArsipSurat::query();

            if ($request->filled('jenis_surat')) {
                $query->where('jenis_surat', $request->jenis_surat);
            }

            if ($request->filled('tanggal_dari') && $request->filled('tanggal_sampai')) {
                $query->whereBetween('tanggal_surat', [$request->tanggal_dari, $request->tanggal_sampai]);
            }

            return datatables()->of($query)
                ->addIndexColumn()
                ->addColumn('jenis_badge', function ($item) {
                    return $item->jenis_surat === 'masuk'
                        ? '<span class="badge bg-primary">Surat Masuk</span>'
                        : '<span class="badge bg-success">Surat Keluar</span>';
                })
                ->addColumn('tanggal_format', fn($item) => $item->tanggal_surat->format('d-m-Y'))
                ->addColumn('action', function ($item) {
                    return view('arsip-surat.action', compact('item'))->render();
                })
                ->rawColumns(['jenis_badge', 'action'])
                ->make(true);
        }

        return view('arsip-surat.index');
    }

    public function download(ArsipSurat $arsipSurat): StreamedResponse
    {
        if (!$arsipSurat->file_pdf || !Storage::disk('public')->exists($arsipSurat->file_pdf)) {
            abort(404, 'File tidak ditemukan.');
        }

        ActivityLogService::catat("Mengunduh arsip surat: {$arsipSurat->nomor_surat}", 'Arsip Surat');

        return Storage::disk('public')->download($arsipSurat->file_pdf);
    }
}
