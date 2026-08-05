<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriBarangRequest;
use App\Models\KategoriBarang;
use App\Services\ActivityLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class KategoriBarangController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = KategoriBarang::withCount('inventaris');

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return view('kategori-barang.action', compact('item'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('kategori-barang.index');
    }

    public function create(): View
    {
        return view('kategori-barang.create');
    }

    public function store(KategoriBarangRequest $request): RedirectResponse
    {
        $kategori = KategoriBarang::create($request->validated());

        ActivityLogService::catat("Menambahkan kategori barang: {$kategori->nama_kategori}", 'Kategori Barang');

        return redirect()->route('kategori-barang.index')->with('success', 'Kategori barang berhasil ditambahkan.');
    }

    public function edit(KategoriBarang $kategoriBarang): View
    {
        return view('kategori-barang.edit', compact('kategoriBarang'));
    }

    public function update(KategoriBarangRequest $request, KategoriBarang $kategoriBarang): RedirectResponse
    {
        $kategoriBarang->update($request->validated());

        ActivityLogService::catat("Memperbarui kategori barang: {$kategoriBarang->nama_kategori}", 'Kategori Barang');

        return redirect()->route('kategori-barang.index')->with('success', 'Kategori barang berhasil diperbarui.');
    }

    public function destroy(KategoriBarang $kategoriBarang): RedirectResponse
    {
        if ($kategoriBarang->inventaris()->exists()) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki data inventaris.');
        }

        ActivityLogService::catat("Menghapus kategori barang: {$kategoriBarang->nama_kategori}", 'Kategori Barang');
        $kategoriBarang->delete();

        return redirect()->route('kategori-barang.index')->with('success', 'Kategori barang berhasil dihapus.');
    }
}
