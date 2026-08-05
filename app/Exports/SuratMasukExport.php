<?php

namespace App\Exports;

use App\Models\SuratMasuk;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SuratMasukExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function __construct(protected ?string $dari = null, protected ?string $sampai = null)
    {
    }

    public function collection()
    {
        $query = SuratMasuk::query()->orderBy('tanggal_surat', 'desc');

        if ($this->dari && $this->sampai) {
            $query->whereBetween('tanggal_surat', [$this->dari, $this->sampai]);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return ['No', 'Nomor Surat', 'Tanggal', 'Pengirim', 'Perihal', 'Keterangan'];
    }

    public function map($item): array
    {
        static $no = 0;
        $no++;

        return [$no, $item->nomor_surat, $item->tanggal_surat->format('d-m-Y'), $item->pengirim, $item->perihal, $item->keterangan];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}