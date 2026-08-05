<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiswaExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return Siswa::with(['kelas', 'tahunAjaran'])->orderBy('nama')->get();
    }

    public function headings(): array
    {
        return ['No', 'NIS', 'NISN', 'Nama', 'Jenis Kelamin', 'Kelas', 'Tahun Ajaran', 'Nama Orang Tua', 'Status'];
    }

    public function map($siswa): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $siswa->nis,
            $siswa->nisn,
            $siswa->nama,
            $siswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan',
            $siswa->kelas->nama_kelas ?? '-',
            $siswa->tahunAjaran ? "{$siswa->tahunAjaran->tahun} ({$siswa->tahunAjaran->semester})" : '-',
            $siswa->nama_orang_tua,
            $siswa->status,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}