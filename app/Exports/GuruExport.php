<?php

namespace App\Exports;

use App\Models\Guru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class GuruExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return Guru::orderBy('nama')->get();
    }

    public function headings(): array
    {
        return ['No', 'NIP', 'Nama', 'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir', 'Jabatan', 'No HP', 'Status'];
    }

    public function map($guru): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $guru->nip,
            $guru->nama,
            $guru->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
            $guru->tempat_lahir,
            $guru->tanggal_lahir ? $guru->tanggal_lahir->format('d-m-Y') : '-',
            $guru->jabatan,
            $guru->no_hp,
            $guru->status,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}