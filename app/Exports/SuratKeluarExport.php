<?php

namespace App\Exports;

use App\Models\SuratKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SuratKeluarExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function __construct(protected ?string $dari = null, protected ?string $sampai = null)
    {
    }

    public function collection()
    {
        $query = SuratKeluar::query()->orderBy('tanggal_surat', 'desc');

        if ($this->dari && $this->sampai) {
            $query->whereBetween('tanggal_surat', [$this->dari, $this->sampai]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return ['No', 'Nomor Surat', 'Tanggal', 'Tujuan', 'Perihal', 'Penandatangan'];
    }

    public function map($item): array
    {
        static $no = 0;
        $no++;

        return [$no, $item->nomor_surat, $item->tanggal_surat->format('d-m-Y'), $item->tujuan, $item->perihal, $item->penandatangan];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}