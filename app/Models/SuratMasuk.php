<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratMasuk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'surat_masuk';

    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'pengirim',
        'perihal',
        'lampiran',
        'file_pdf',
        'keterangan',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_surat' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
