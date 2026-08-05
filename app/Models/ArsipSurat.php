<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
    use HasFactory;

    protected $table = 'arsip_surat';

    protected $fillable = [
        'jenis_surat',
        'surat_id',
        'nomor_surat',
        'tanggal_surat',
        'file_pdf',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_surat' => 'date',
        ];
    }
}
