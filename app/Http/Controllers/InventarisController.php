<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventarisRequest;
use App\Models\Inventaris;
use App\Models\KategoriBarang;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class InventarisController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Inventaris::with('kategori')->select('inventaris.*');

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('kategori', fn($item) => $item->kategori->nama_kategori ?? '-')
                ->addColumn('kondisi_badge', function ($item) {
                    $color = match ($item->kondisi) {
                        'Baik' => 'success',
                        'Rusak Ringan' => 'warning',
                        'Rusak Berat' => 'danger',
                        default => 'secondary',
                    };
                    return "<span class='badge bg-{$color}'>{$item->kondisi}</span>";
                })
                ->addColumn('action', function ($item) {
                    return view('inventaris.action', compact('item'))->render();
                })
                ->rawColumns(['kondisi_badge', 'action'])
                ->make(true);
        }

        return view('inventaris.index');
    }

    public function create(): View
    {
        $kategori = KategoriBarang::pluck('nama_kategori', 'id');
        return view('inventaris.create', compact('kategori'));
    }

    public function store(InventarisRequest $request): RedirectResponse
    {
        $inventaris = Inventaris::create($request->validated());

        ActivityLogService::catat("Menambahkan data inventaris: {$inventaris->nama_barang}", 'Inventaris');

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil ditambahkan.');
    }

    public function edit(Inventaris $inventaris): View
    {
        $kategori = KategoriBarang::pluck('nama_kategori', 'id');
        return view('inventaris.edit', compact('inventaris', 'kategori'));
    }

    public function update(InventarisRequest $request, Inventaris $inventaris): RedirectResponse
    {
        $inventaris->update($request->validated());

        ActivityLogService::catat("Memperbarui data inventaris: {$inventaris->nama_barang}", 'Inventaris');

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil diperbarui.');
    }

    public function destroy(Inventaris $inventaris): RedirectResponse
    {
        ActivityLogService::catat("Menghapus data inventaris: {$inventaris->nama_barang}", 'Inventaris');
        $inventaris->delete();

        return redirect()->route('inventaris.index')->with('success', 'Data inventaris berhasil dihapus.');
    }
}
