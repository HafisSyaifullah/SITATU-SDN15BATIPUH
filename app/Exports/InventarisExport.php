<?php

namespace App\Exports;

use App\Models\Inventaris;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InventarisExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return Inventaris::with('kategori')->orderBy('nama_barang')->get();
    }

    public function headings(): array
    {
        return ['No', 'Kode Barang', 'Nama Barang', 'Kategori', 'Jumlah', 'Kondisi', 'Lokasi', 'Tahun Pengadaan'];
    }

    public function map($item): array
    {
        static $no = 0;
        $no++;

        return [$no, $item->kode_barang, $item->nama_barang, $item->kategori->nama_kategori ?? '-', $item->jumlah, $item->kondisi, $item->lokasi, $item->tahun_pengadaan];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}