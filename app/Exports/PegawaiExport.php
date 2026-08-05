<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PegawaiExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return Pegawai::orderBy('nama')->get();
    }

    public function headings(): array
    {
        return ['No', 'NIP', 'Nama', 'Jabatan', 'No HP', 'Alamat', 'Status'];
    }

    public function map($pegawai): array
    {
        static $no = 0;
        $no++;

        return [$no, $pegawai->nip, $pegawai->nama, $pegawai->jabatan, $pegawai->no_hp, $pegawai->alamat, $pegawai->status];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}